<?php
declare(strict_types=1);

class PageController extends Controller
{
    public function about(): void
    {
        $reviewsData = $this->loadGoogleReviews();

        $this->render('pages/about', [
            'title' => 'Despre noi',
            'metaTitle' => 'Despre noi: producător uși filomuro & uși invizibile | Secret Doors Premium',
            'metaDescription' => 'Suntem producător uși filomuro și uși invizibile personalizate pentru apartament și birouri în București. Soluții moderne pereți, montaj uși filomuro, plintă ascunsă și profile aluminiu interior.',
            'googleReviews' => $reviewsData['reviews'],
            'googleRating' => $reviewsData['rating'],
            'googleRatingTotal' => $reviewsData['user_ratings_total'],
            'googlePlaceName' => $reviewsData['place_name'],
            'googleReviewsEnabled' => $reviewsData['enabled'],
            'googleReviewsError' => $reviewsData['error'],
        ]);
    }

    /**
     * Citește recenzii Google Place Details cu cache local.
     *
     * @return array{
     *   enabled: bool,
     *   place_name: string,
     *   rating: float|null,
     *   user_ratings_total: int,
     *   reviews: array<int, array{
     *      author_name: string,
     *      rating: int,
     *      text: string,
     *      relative_time_description: string
     *   }>,
     *   error: string
     * }
     */
    private function loadGoogleReviews(): array
    {
        $apiKey = (string) (defined('GOOGLE_PLACES_API_KEY') ? GOOGLE_PLACES_API_KEY : getenv('GOOGLE_PLACES_API_KEY'));
        $placeId = (string) (defined('GOOGLE_PLACE_ID') ? GOOGLE_PLACE_ID : getenv('GOOGLE_PLACE_ID'));
        $ttl = (int) (defined('GOOGLE_REVIEWS_CACHE_TTL') ? GOOGLE_REVIEWS_CACHE_TTL : 21600);

        $result = [
            'enabled' => false,
            'place_name' => '',
            'rating' => null,
            'user_ratings_total' => 0,
            'reviews' => [],
            'error' => '',
        ];

        if ($apiKey === '' || $placeId === '') {
            $result['error'] = 'Google reviews indisponibile: lipsesc GOOGLE_PLACES_API_KEY sau GOOGLE_PLACE_ID.';
            return $result;
        }

        $cachePath = project_root() . DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'google-reviews.json';
        $cached = $this->readGoogleReviewsCache($cachePath, $ttl);
        if ($cached !== null) {
            return $cached;
        }

        $query = http_build_query([
            'place_id' => $placeId,
            'fields' => 'name,rating,user_ratings_total,reviews',
            'reviews_sort' => 'newest',
            'language' => 'ro',
            'key' => $apiKey,
        ]);
        $url = 'https://maps.googleapis.com/maps/api/place/details/json?' . $query;
        $payload = $this->httpGetJson($url);

        if (!is_array($payload) || ($payload['status'] ?? '') !== 'OK' || !isset($payload['result']) || !is_array($payload['result'])) {
            $result['error'] = 'Google reviews indisponibile: răspuns API invalid.';
            return $result;
        }

        $place = $payload['result'];
        $reviews = [];
        foreach (($place['reviews'] ?? []) as $entry) {
            if (!is_array($entry)) {
                continue;
            }
            $reviews[] = [
                'author_name' => trim((string) ($entry['author_name'] ?? 'Client')),
                'rating' => max(1, min(5, (int) ($entry['rating'] ?? 5))),
                'text' => trim((string) ($entry['text'] ?? '')),
                'relative_time_description' => trim((string) ($entry['relative_time_description'] ?? '')),
            ];
            if (count($reviews) >= 6) {
                break;
            }
        }

        $result = [
            'enabled' => true,
            'place_name' => trim((string) ($place['name'] ?? 'Secret Doors Premium')),
            'rating' => isset($place['rating']) ? (float) $place['rating'] : null,
            'user_ratings_total' => (int) ($place['user_ratings_total'] ?? 0),
            'reviews' => $reviews,
            'error' => '',
        ];

        $this->writeGoogleReviewsCache($cachePath, $result);
        return $result;
    }

    private function readGoogleReviewsCache(string $cachePath, int $ttl): ?array
    {
        if (!is_file($cachePath)) {
            return null;
        }
        $raw = @file_get_contents($cachePath);
        if ($raw === false || $raw === '') {
            return null;
        }
        $decoded = json_decode($raw, true);
        if (!is_array($decoded) || !isset($decoded['fetched_at'], $decoded['data']) || !is_array($decoded['data'])) {
            return null;
        }
        if ((time() - (int) $decoded['fetched_at']) > max(300, $ttl)) {
            return null;
        }
        return $decoded['data'];
    }

    private function writeGoogleReviewsCache(string $cachePath, array $data): void
    {
        $dir = dirname($cachePath);
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }
        @file_put_contents($cachePath, json_encode([
            'fetched_at' => time(),
            'data' => $data,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    private function httpGetJson(string $url): ?array
    {
        $raw = null;

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_CONNECTTIMEOUT => 7,
                CURLOPT_FOLLOWLOCATION => true,
            ]);
            $response = curl_exec($ch);
            $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
            curl_close($ch);
            if ($response !== false && $status >= 200 && $status < 300) {
                $raw = $response;
            }
        }

        if ($raw === null) {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 10,
                    'ignore_errors' => true,
                    'method' => 'GET',
                ],
            ]);
            $response = @file_get_contents($url, false, $context);
            if ($response !== false) {
                $raw = $response;
            }
        }

        if ($raw === null || $raw === '') {
            return null;
        }

        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : null;
    }
}
