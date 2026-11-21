# Document consistency changes — 2026-11-20

Completed the document-consistency task for the 46 HTML/HTM pages outside archive directories in the original audit. The original audit is retained as a historical snapshot. This note records the resulting declarations; its old missing-declaration counts no longer describe these 46 files.

## Document types

- 38 ordinary legacy pages: complete HTML 4.01 Transitional declaration, including the loose.dtd system identifier.
- Five frame wrappers (`results/index.html`, `scene3/index.html`, `theart/index.html`, `theland/index.html`, `thepeople/index.html`): complete HTML 4.01 Frameset declaration, including frameset.dtd. Transitional does not include the frame/frameset elements.
- Three native video pages (`video1/index1.htm`, `video1/index2.htm`, `video2/index1.htm`): HTML5 retained because they use video/source elements.

This is a pragmatic declaration choice for the current page families, not a claim of full DTD or HTML conformance. Existing object/embed integrations, legacy attributes, and previously documented structural issues still need separate review. Modernizing the legacy pages to HTML5 can follow the markup/component work.

## Uniform declaration order

The doctype is the first line, before formatting comments or whitespace. Each html element declares `lang="en"`. The first two elements in each head are:

```html
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
```

The HTTP-equiv syntax is used consistently across both legacy and HTML5 pages; modern HTML recognizes this UTF-8 declaration too. Old encoding/viewport declarations were removed to avoid conflicts or duplicates. Encoding appears within the first 1,024 bytes in every file. All 46 sources were ASCII-only before the change and remain valid UTF-8, so no non-ASCII text needed conversion.

Existing head content follows these two declarations. Other formatting, titles, descriptions, assets, styles, scripts, markup and page behavior were preserved. In particular, the user's closing object-tag fix in thepeople/index_main.html remains present. The three HTML5 video pages were included to align order and encoding syntax with the rest of the set.

## Verification

- All 46 files have exactly one doctype on line one, one language declaration, one UTF-8 declaration and one viewport declaration.
- Source comparisons against snapshots taken immediately before this task confirm that non-header content is unchanged, including pre-existing edits.
- Local Chrome checks used a temporary server at http://127.0.0.1:8765 in an isolated browser context.
- Before/after geometry comparisons at a 1,000 × 800 iframe viewport covered 11 representative documents with scripts sandboxed: all three landings, intro_new/index.htm, scene3/index_newnew.htm, the scene3/results frame wrappers, thepeople/index_main.html, and all three native video pages.
- Artwork table dimensions and positions matched in all five image-table pages. Native video dimensions and positions matched in all three video pages. Two legacy body boxes now shrink to content height rather than the quirks-mode viewport height; their measured tables stayed in place.
- After a cache-bypassing reload with scripts enabled, scene3's wrapper and both child documents reported CSS1Compat, en and UTF-8. Both music and main frames instantiated Ruffle players; the main stage measured 760 × 420 pixels.
- The complete legacy doctypes change browser parsing from quirks mode to CSS1Compat (HTML 4 Transitional uses the browser's limited-quirks/almost-standards mode). These local checks do not establish pixel parity on every page or on mobile devices.

Viewport metadata does not make the fixed-width artwork responsive. Full mobile layout, sound playback, SWF interactions, PHP execution and production HTTP encoding headers were not verified in this task. A server-supplied conflicting charset header can override an HTML declaration and requires a separate hosting check.

## Scope left for later tasks

Archive directories (10 historical HTML files), PHP-generated pages, content/accessibility fixes, frameset/fallback structure, styles, script extraction, componentization and minification were not changed. No dependencies were installed and no commit, push or deployment was performed.

## References

- [W3C HTML 4.01 document structure and doctypes](https://www.w3.org/TR/html401/struct/global.html)
- [W3C HTML 4.01 frame documents](https://www.w3.org/TR/html401/present/frames.html)
- [WHATWG HTML metadata and encoding](https://html.spec.whatwg.org/multipage/semantics.html)
