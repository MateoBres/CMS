<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
@foreach ($retailers as $item)
  <url>
        <loc>https://www.spesavicino.it/azienda/{{ $item->slug}}/{{ $item->vat }}</loc>
        <lastmod>{{ $item->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
  </url>
@endforeach
</urlset>


