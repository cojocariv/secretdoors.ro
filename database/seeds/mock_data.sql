USE secretdoors;

INSERT INTO categorii (name, slug) VALUES
('Usi filomuro', 'usi-filomuro'),
('Usi invizibile', 'usi-invizibile'),
('Sisteme glisante', 'sisteme-glisante');

INSERT INTO produse (categorie_id, name, slug, short_description, technical_specs, price, finish, dimensions, image_url, position) VALUES
(1, 'Filomuro Prime 230', 'filomuro-prime-230', 'Usa premium flush cu toc ascuns.', 'Cadru aluminiu, 44 dB izolare fonica.', 3290, 'Lac mat grafit', '90x230 cm', 'https://images.unsplash.com/photo-1616486029423-aaa4789e8c9a?q=80&w=1200&auto=format', 1),
(2, 'Invisible Line 210', 'invisible-line-210', 'Integrare completa in perete, fara pervaz.', 'Balamale ascunse 3D, toc zincat.', 2890, 'White primer', '80x210 cm', 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=1200&auto=format', 2),
(3, 'Sliding Pocket Pro', 'sliding-pocket-pro', 'Sistem glisant in perete pentru spatii compacte.', 'Sina silentioasa, amortizare soft-close.', 4190, 'Anodizat negru', '100x220 cm', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=1200&auto=format', 3);

INSERT INTO proiecte (title, slug, summary, project_type, image_url, gallery_json, position) VALUES
('Penthouse Nordului', 'penthouse-nordului', 'Integrare filomuro in living minimalist cu panouri decorative.', 'rezidential', 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=1200&auto=format', JSON_ARRAY('https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=1200&auto=format'), 1),
('Office Creative Hub', 'office-creative-hub', 'Sistem glisant acustic pentru zone de meeting.', 'comercial', 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format', JSON_ARRAY('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format'), 2);

INSERT INTO articole (title, slug, excerpt, body, cover_image) VALUES
('Trenduri 2026 pentru usi filomuro', 'trenduri-2026-usi-filomuro', 'Ce finisaje si culori domina proiectele premium.', 'In 2026 vedem o crestere semnificativa a finisajelor metalice subtile, a liniilor continue si a accentului pe detalii constructive invizibile.', 'https://images.unsplash.com/photo-1600566752355-35792bedcfea?q=80&w=1200&auto=format'),
('Cum alegi sistemul glisant potrivit', 'cum-alegi-sistemul-glisant-potrivit', 'Ghid tehnic rapid pentru rezidential si comercial.', 'Alegerea depinde de grosimea peretelui, frecventa de utilizare si nivelul de izolare acustica dorit.', 'https://images.unsplash.com/photo-1600607687644-c7171b42498f?q=80&w=1200&auto=format');
