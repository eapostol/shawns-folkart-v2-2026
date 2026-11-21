# Shawn's Folk Art HTML consistency and delivery audit

Date: 2026-11-20  
Target: local working directory `D:\projects\2025\shawnsfolkart\2026-11-17`  
Status: analysis only; no site source changes made.

## Review summary

The best first step is to standardize the existing page families, then extract shared styles and helpers, and finally minify generated delivery files. A framework migration is not necessary to start. Preserve the Flash/Ruffle integration and existing URLs while doing this.

The scan covers **46 HTML/HTM pages outside archive directories**, totaling **150,568 source bytes (147.0 KiB)**. An additional **10 archived HTML/HTM files** were inventoried separately, for **56 HTML/HTM files in the project**. Filename variants outside archive directories are included in the 46; inclusion does not prove a page is currently used. Three PHP files were inspected as supplemental HTML-bearing sources, outside those counts.

Most significant findings:

1. `thepeople/index_main.html` has a confirmed missing `</object>` closing tag.
2. 37/46 pages omit a doctype; 43 omit `lang`; 43 omit viewport metadata; 23 lack an explicit charset declaration.
3. Four frame wrappers are byte-for-byte identical. Thirteen pages repeat the same stage CSS block after whitespace normalization; three more share a borderless variant.
4. 21 pages load the same Ruffle script, but configuration differs in meaningful ways. Five other Flash pages have no local Ruffle loader.
5. All 46 pages have a title, but titles, descriptions, branding, and media labels vary in quality and accuracy. Actual content and navigation are often inside SWFs or images rather than accessible HTML.
6. Delivery is likely influenced more by media and the Ruffle runtime than by HTML whitespace. This is an inference from local file sizes, not a measured performance result.

## Scope, method, and limits

Read the current working files, including six pre-existing modified files: `results/index.html`, `results/index_main.html`, `scene3/index_main.html`, `video1/index1.htm`, `video2/index.htm`, and `video2/index1.htm`. Those edits were preserved. No applicable AGENTS.md was found in the project or the two checked parent directories.

Used Python's standard HTMLParser, raw-source checks, SHA-256 comparisons, whitespace-normalized inline block comparisons, source searches, and relative local file existence checks. Repeated block comparisons are textual: they are not an AST or semantic equivalence proof. HTMLParser is permissive; this is **not a full HTML conformance validation**. Closing-tag counts were checked for html, head, body, frameset, script, style, object, table, div, a, form, and textarea, with the concrete defect manually confirmed.

No live site/browser behavior, mobile rendering, HTTP response headers, compression, cache policy, network waterfall, Lighthouse, SWF-internal navigation, form submissions, or PHP execution was tested. External links were not tested. Do not interpret a local asset existing as proof that it loads or works on the server. Case-sensitive hosting differences and generated/runtime URLs remain separate checks.

## Similarities and meaningful differences

| Family | Files | Shared structure | Differences to preserve or resolve |
|---|---|---|---|
| Random entry | `index.html` | Metadata/icons, inline redirect | Uses localStorage and location.replace to avoid consecutive landing repeats when storage works. Body is empty; needs fallback links. |
| Image-slice landings | `index-01.html`, `index-02.html`, `index-03.html` | 760px artwork, table slices, icons/metadata, centering, MM_preloadImages | 34 / 48 / 15 image elements; different markup selectors and alt text; preserve artwork composition and click targets. |
| Frame wrappers | `results/index.html`, `scene3/index.html`, `theart/index.html`, `theland/index.html`, `thepeople/index.html` | Two frames: silent music placeholder plus index_main.html; same general metadata | Four are exact copies; results differs in source formatting/content. Relative index_main.html resolves differently in each directory. |
| Main Flash sections | The five corresponding `index_main.html` files | Music loading, popup helper, SWF object/embed, Ruffle, stage styles | Different SWFs, frame guards, rewrite rules, and popup behavior. scene3 has stronger wrapper handling and special video popup options. |
| Other Flash pages | Comments, links, results/results, scene2, scene3 popups/credits, artist, shed, works, Flash video | Ruffle plus legacy object/embed and centered stage on migrated pages | Rewrite rules, borders, backgrounds, and dimensions differ; five older pages lack a loader. |
| Music documents | `music.htm`, `music2.htm`, `music3.htm`, `music_old.htm`, `music_none.htm` | Small documents used for soundtrack frame | Different movie paths, dimensions and overlay behavior; music_none is intentionally silent and needs no player. |
| Native video | `video1/index1.htm`, `video1/index2.htm`, `video2/index1.htm` | HTML5 doctype, en, UTF-8, viewport, video/source, controls and metadata preload | Two share controls JS; index2 keeps ordinary controls. Flex versus grid, player dimensions and download-link placement differ. |
| Utilities/static extras | `links/translator.htm`, `advert/index1.htm`, `intro_new/index.htm`, `theartist/soon.htm`, video menus, older variants | Legacy presentation markup and icons | Translator has two unlabeled textareas; old media menu labels no longer describe the linked HTML5 players. |

### Repeated snippets worth extracting

All locations below refer to the audited source, before any future edits.

- **Head partial:** every one of the 46 pages includes favicon/manifest links; root pages use `./favicon/`, children use `../favicon/`. Generate those links from one source with a depth-aware asset prefix. Titles and descriptions should remain page-specific.
- **Player stylesheet:** 13 whitespace-normalized copies of the same 683-character stage style content, plus three copies of a 647-character borderless variant. The 13-copy group has 8,196 redundant characters beyond its first copy; the three-copy group has 1,294. These are source-character figures, not transfer-byte savings. A shared base stylesheet plus an explicit border modifier could cover both.
- **Ruffle base configuration:** 12 identical 185-character inline bodies configure autoplay, splashScreen and hidden unmute overlay. Six more share a 405-character body adding common navigation URL rewrites. Keep the remaining configurations as explicit overrides.
- **Landing preload helper:** identical 288-character body in all three landings (`index-01.html:49`, `index-02.html:49`, `index-03.html:52`). Data lists differ.
- **Music helper:** three identical 378-character inline bodies in results/art/land include commented-out randomization. scene3 retains executable randomization before assigning music3; people keeps that old randomization inside a block comment and only executes the music3 assignment.
- **Popup helper:** three identical 545-character bodies in results/art/land; people has formatting variations; scene3 adds video-specific window features. `links/index.html` uses a separate loadwindow API.
- **Frame guard:** art/land/people have equivalent normalized inline blocks. scene3 has more elaborate origin/path/error handling; do not replace that with the simpler guard without reviewing why it exists.
- **Video controls helper:** the 1,123-character inline body is identical in `video1/index1.htm:46` and `video2/index1.htm:45`.
- **Legacy object/embed markup:** 26 pages repeat the same broad pattern. A future template can accept movie path, dimensions, background and player options. Object param and embed source values currently repeat the movie URL for legacy compatibility; do not delete one path until Ruffle playback is verified.

Build-time partials/templates are a good fit: publish ordinary static HTML while maintaining shared source once. Shared CSS/JS can also improve reuse through browser caching. Client-side fetching of head/navigation fragments would add runtime dependencies and is unnecessary for this site's present structure.

## Missing tags, attributes, and structural issues

### Definite repair candidates

| Priority | Evidence | Finding and proposed correction |
|---|---|---|
| High | `thepeople/index_main.html:109-114` | Object opens at 109; embed is followed by closing div without `</object>`. Add the missing object end tag before div, then verify the Ruffle stage. |
| High | Five wrapper pages; e.g. `results/index.html:15-23`, `scene3/index.html:26-34` | noframes appears after the closing frameset, and its body is empty. In the legacy HTML 4 Frameset structure, noframes belongs inside frameset. Provide meaningful fallback navigation; longer term replace the frame architecture after music/navigation review. |
| Medium | `scene3/index_newnew.htm:463` | map is directly inside table after rows. Move map outside the table in a future correction; it is not a table row. Verify the associated image-map click target. |
| Medium | `scene3/index_newnew.htm:25,53` | Two description meta elements; first is the generator placeholder `FW4 DW4 HTML`. Keep one meaningful description. |
| Medium | `advert/index1.htm:29`; 35 images in `scene3/index_newnew.htm` | 36 image elements lack alt attributes. Supply meaningful descriptions for content images and empty alt for decorative slices/spacers. The linked image at scene3 line 243 needs a useful link name. |
| Medium | `links/translator.htm:95,114` | Both textareas lack associated labels/accessible names. Add explicit labels and ids. Use buttons for translation actions currently expressed as javascript links at 109-110. Missing form action/method is not itself a defect for this local JS utility. |
| Low | `theartist/soon.htm:36,40` | alt is placed on anchor elements, where it does not name the link. Keep descriptive link text/image alt; consider a concrete fallback URL for history.back navigation. |
| Low | `music_old.htm` | Explicit closing embed tag appears even though embed is a void HTML element. Standardize void-element syntax in a later cleanup. |

Apart from the object defect, the selected opening/closing tag counts matched in the 46-page set. Equal counts do not prove correct nesting or valid HTML. Case differences, unquoted valid attribute values, optional end tags, and slash-style void tags should not all be labeled missing-tag errors; choose a formatting convention separately.

### Document-level consistency

| Item | Measured finding | Recommendation and qualification |
|---|---|---|
| Doctype | 37 missing; six HTML 4.01 Transitional declarations; three HTML5 | Use HTML5 for modernized ordinary documents. Doctype changes can alter quirks-mode rendering, so compare layouts. A legacy frameset cannot become conforming HTML5 by adding an HTML5 doctype. |
| Language | 43 missing; only the three native video pages use en | Add an appropriate language declaration as pages are standardized. |
| Character encoding | 23 without explicit charset; three UTF-8; 20 ISO-8859-1 | Verify file bytes and served encoding, then convert deliberately to UTF-8. `content="text/html;"` is not an encoding declaration. No UTF-8 decoding replacements occurred in the 46 scanned sources, but that does not establish server headers. |
| Viewport | Missing on 43 pages | Add viewport metadata with responsive-layout review. Fixed 760px image tables may overflow; metadata alone does not make them responsive. |
| Title | Present on all 46 | Normalize branding and use meaningful page names. Examples needing review: results/index_main `Main2`, scene3/index_main `Main2`, scene3/a2x4popup `a2x4popup`, scene3/whats_new `whats_new`, scene5a `movie5_meat_ver2a`. Distinguish the three identical native-video titles if they represent distinct content. |
| Description | Missing on 27; most existing descriptions repeat site-wide prose | Add tailored descriptions to public content pages. Music frames and internal utility pages do not need artificial SEO prose. Standardize branding/capitalization in retained shared copy. |
| Headings/landmarks | No h1, main or nav elements in any of the 46 | Add useful HTML heading/content/navigation structure where pages represent public content. Do not add empty semantic tags or meaningless headings to hidden audio frames. |
| Shared stylesheet | No stylesheet link in any of the 46 | CSS is inline. `css/master.css` contains an old centercontent rule; no source reference to that file was found in the checked HTML/HTM/JS/PHP set. Verify SWF/runtime references before treating it as removable. |
| Duplicate ids | None detected within the 46 documents | No repair identified by this check. |

## Missing or outdated content

- **Entry fallback:** `index.html` has an empty body and no noscript navigation. Provide visible links to the landing choices for script-disabled/failing navigation. Preserve the current random/no-consecutive-repeat behavior when scripts work.
- **Flash fallback/navigation:** most Flash wrappers provide only object/embed rather than useful readable content or alternate navigation. `comments/index.html:76`, `theworks/index_old.html:30`, and `scene3/whats_new.html:28` contain empty links. Give meaningful destinations accessible names, or remove purposeless placeholders after checking dependencies.
- **Five Flash pages without a loader:** `scene3/index_new.html`, `scene3/whats_new.html`, `scene5/index.html`, `scene5a/index.html`, `theworks/index_old.html`. Standalone source does not initialize Ruffle. Determine which are reachable/needed, then migrate or intentionally archive them. Do not infer they are dead from filenames or absent HTML links: SWFs may navigate to them.
- **Native video captions/transcripts:** none of the three native video pages includes a track element or transcript. Review the recordings for speech/meaningful audio and provide suitable captions/transcripts. This audit did not inspect their content or establish caption requirements for each recording.
- **Video fallback inconsistency:** index1 in both video directories puts its download link inside video fallback content, which ordinarily is not displayed when the browser supports video but the resource fails. `video1/index2.htm` has an always-visible separate download link. Consider consistent visible recovery links, with layout appropriate to popup dimensions.
- **Outdated video menu copy:** `video1/index.htm:35-39` still labels native MP4 player destinations as Apple Quicktime and Windows Media Player and quotes old sizes. `video2/index.htm:34` still says Apple Quicktime. The Flash MX entry also advertises an old player requirement despite its linked page loading Ruffle. Update labels and sizes after choosing which alternatives to retain.
- **Generator and obsolete plugin copy:** scene3/index_newnew has `FW4 DW4 HTML` plus a Flash 5 download image-map link; many object/embed attributes refer to old HTTP Macromedia plugin downloads. Review alongside the Ruffle migration rather than treating those URLs as modern installation guidance.
- **Image text:** landings 01/02 use many empty alt values, whereas landing 03 has nonempty alt on all 15 images. Empty alt is correct for decorative slices, but meaningful text embedded in artwork needs an accessible equivalent. Do not replace every spacer alt with a filename. `intro_new/index.htm` has 16 empty-alt images, so review whether important content is available elsewhere.

## Differences that must remain explicit during deduplication

1. `links/index.html:58` adds both common/nav rewrites and links2.txt -> links-public.txt mapping. Six other configurations share common/nav rewrites. `theartist/insp.htm` has a separate old comments URL rewrite. Preserve URL resolution against the document URL when moving scripts to another directory.
2. `music_old.htm` uses visible unmute overlay; other current configurations use hidden. Music-only pages and visible stage pages have different purposes/dimensions.
3. Thirteen stage styles include a gray border; links, scene2/index_new and scene3/index_main share a borderless variant; credits uses another style. Confirm intended visual differences before unifying.
4. Native video controls differ: two popup players change control visibility with pointer/keyboard state; video1/index2 leaves controls native. Keep the touch and keyboard paths working if sharing the script.
5. Native video layout differs: video1/index1 uses flex; video2/index1 uses grid. video2 has CSS width 240px but lacks HTML width/height attributes. Review intrinsic dimensions/layout stability rather than copying the first recording's aspect ratio blindly.
6. `scene3/index_main.html` has a more robust frame guard and extra video popup features. Popup helper names may be called by SWFs; preserve public global function names unless SWF calls are mapped.
7. `index-01` styles #maintable, `index-02` styles .sliced-image-table, and `index-03` styles a table inside .sliced-image-container. Generate consistent shell markup only after screenshot comparison of all three artworks.

## Performance and redundancy opportunities

| Order | Opportunity | Evidence / expected benefit / remaining proof |
|---|---|---|
| 1 | Establish browser/network baseline | Record cold and warm visits to each landing, scene3, one music-backed section, links and both recordings. No timings have been measured here. |
| 2 | Remove unintended repeated work | scene3/index_main loadatune at 67-79 navigates the music frame to music.htm or music2.htm and immediately assigns music3.htm. This makes the random choice redundant; browsers may cancel intermediate navigation, so actual request savings need measurement. |
| 3 | Consolidate shared CSS and helpers | Repeated blocks above are concrete candidates. Expect fewer maintenance copies and potential warm-cache benefits. New shared files add cold-load requests, so verify net effect. Keep critical loading order and Ruffle configuration-before-loader behavior. |
| 4 | Review image preload strategy | The landing preload calls occur in body onload, after ordinary load discovery. All listed URLs already occur in img markup: 5/17 unique sources on 01, 10/27 on 02, 15/15 on 03. These calls do not start the initial load earlier. They can reuse cache and should not be described as guaranteed duplicate network downloads. Review actual request/decode behavior before removing. |
| 5 | Reduce sliced-image overhead where useful | 01 has 34 img elements / 17 unique image URLs; 02 has 48 / 27; 03 has 15 / 15. Consider consolidating decorative slices while preserving interactive regions and artwork. Element count is not request count. Do not lazy-load the above-the-fold landing artwork indiscriminately. |
| 6 | Review runtime/media delivery | Ruffle loader is 465,885 bytes; two WASM variants are 14,302,754 and 14,227,884 bytes on disk. They are alternative assets, not proof both download on one visit. video1/shawn.mp4 is 5,105,876 bytes; video2/folkartshow2002.mp4 is 1,732,818 bytes. Measure selected runtime, media start behavior and server compression/caching. |
| 7 | Minify generated delivery output | Keep readable source and generate minified HTML/CSS/JS as a later build step. Test HTML whitespace, inline handlers, regexes, SWF hooks, paths and licenses. No compression/minification savings percentage is established by this audit. |
| 8 | Verify server compression and caching | Check real response headers for HTML/CSS/JS/WASM plus media caching/range delivery. `.htaccess_off` is inactive-looking legacy auth configuration, not evidence of current caching/compression. Hosting capabilities are unverified. |
| 9 | Separate archival material from deployment | Confirm external/SWF references before excluding old variants or archives. Excluding unused files reduces deployment footprint but does not automatically speed pages that never request them. |

### Additional JavaScript cleanup candidate

`links/index.html:36-40` assigns boolean `isCenter = true` and subsequently compares it with the string `"true"`. That comparison is false, so the intended centering branch is skipped. The helper also assigns variables without local declarations, as do some popup helpers. This is a related source-level correctness finding, not a measured performance issue. Preserve any global helper APIs required by SWFs while localizing implementation variables.

## Proposed implementation sequence for later approval

1. Select public/canonical versus archive routes using source references, SWF behavior and hosting evidence. Preserve URLs initially.
2. Fix the confirmed missing object tag, table/map placement, duplicate description and meaningful accessible names/content. Run a full HTML validator for each retained page; separately evaluate the legacy frameset pages under their intended model.
3. Agree on a document convention: HTML5 for ordinary pages, UTF-8, lang, page-specific title/description, consistent favicon block, consistent formatting and viewport with responsive review.
4. Introduce build-time head/page-family partials and shared player/landing/video styles and helpers. Preserve rewrite rules, music behavior, frame guards and popup contracts as parameters/overrides.
5. Compare before/after screenshots and behavior on desktop/mobile; verify sound activation, navigation, popups, links loading, keyboard/touch controls and media fallbacks.
6. Measure cold/warm loads, then address assets, compression and caching. Add minification to generated output only after the source is consistent and behavior passes review.

No implementation, deletion, archival move, dependency installation, minification or deployment is authorized/performed as part of this report.

## Per-page inventory (46 pages outside archive directories)

Legend: H5 = HTML5 doctype; H4 = HTML 4.01 Transitional; none = missing doctype. Encoding is the declaration in source, not verified HTTP encoding. Gaps list D = doctype, L = lang, C = charset, V = viewport, M = description; metadata gaps are not all errors or equally relevant to every page.

| File | Bytes | Family marker | Doctype | Encoding | Gaps | Additional source finding |
|---|---:|---|---|---|---|---|
| `advert/index1.htm` | 797 | images | none | iso-8859-1 | D, L, V, M | 1 img without alt |
| `comments/index.html` | 2,789 | Flash/Ruffle | none | none | D, L, C, V, M | - |
| `index-01.html` | 11,780 | images | none | none | D, L, C, V | - |
| `index-02.html` | 15,196 | images | none | none | D, L, C, V | - |
| `index-03.html` | 12,364 | images | none | none | D, L, C, V | - |
| `index.html` | 2,504 | utility/text | none | iso-8859-1 | D, L, V | empty body / JS-only redirect |
| `intro_new/index.htm` | 4,129 | images | none | iso-8859-1 | D, L, V, M | - |
| `links/index.html` | 3,880 | Flash/Ruffle | H4 | none | L, C, V, M | - |
| `links/translator.htm` | 4,500 | utility/text | none | iso-8859-1 | D, L, V, M | - |
| `music.htm` | 1,641 | Flash/Ruffle | none | iso-8859-1 | D, L, V, M | - |
| `music2.htm` | 1,645 | Flash/Ruffle | none | iso-8859-1 | D, L, V, M | - |
| `music3.htm` | 1,726 | Flash/Ruffle | none | ISO-8859-1 | D, L, V, M | - |
| `music_none.htm` | 680 | utility/text | none | iso-8859-1 | D, L, V, M | - |
| `music_old.htm` | 1,382 | Flash/Ruffle | none | iso-8859-1 | D, L, V, M | - |
| `results/index.html` | 1,394 | frameset | none | iso-8859-1 | D, L, V | 2 frames without title; empty fallback |
| `results/index_main.html` | 4,518 | Flash/Ruffle | none | none | D, L, C, V | - |
| `results/results.html` | 2,577 | Flash/Ruffle | none | ISO-8859-1 | D, L, V, M | - |
| `scene2/index.htm` | 3,220 | Flash/Ruffle | none | none | D, L, C, V | - |
| `scene2/index_new.htm` | 2,905 | Flash/Ruffle | H4 | none | L, C, V | - |
| `scene3/a2x4popup.html` | 2,874 | Flash/Ruffle | none | none | D, L, C, V, M | - |
| `scene3/credits.html` | 2,260 | Flash/Ruffle | none | none | D, L, C, V | - |
| `scene3/index.html` | 1,324 | frameset | none | iso-8859-1 | D, L, V | 2 frames without title; empty fallback |
| `scene3/index_main.html` | 5,451 | Flash/Ruffle | none | none | D, L, C, V | - |
| `scene3/index_new.html` | 1,480 | Flash, no loader | none | none | D, L, C, V, M | - |
| `scene3/index_newnew.htm` | 11,674 | images | none | none | D, L, C, V | 35 img without alt; duplicate description; map inside table; legacy dispatcher/VBScript |
| `scene3/whats_new.html` | 1,877 | Flash, no loader | none | ISO-8859-1 | D, L, V, M | - |
| `scene5/index.html` | 1,580 | Flash, no loader | none | none | D, L, C, V, M | - |
| `scene5a/index.html` | 1,415 | Flash, no loader | none | none | D, L, C, V, M | - |
| `theart/index.html` | 1,324 | frameset | none | iso-8859-1 | D, L, V | 2 frames without title; empty fallback |
| `theart/index_main.html` | 4,256 | Flash/Ruffle | none | none | D, L, C, V | - |
| `theartist/index.html` | 2,553 | Flash/Ruffle | none | none | D, L, C, V, M | - |
| `theartist/insp.htm` | 2,573 | Flash/Ruffle | none | none | D, L, C, V, M | - |
| `theartist/soon.htm` | 1,525 | images | none | iso-8859-1 | D, L, V, M | - |
| `theland/index.html` | 1,324 | frameset | none | iso-8859-1 | D, L, V | 2 frames without title; empty fallback |
| `theland/index_main.html` | 4,260 | Flash/Ruffle | none | none | D, L, C, V | - |
| `thepeople/index.html` | 1,324 | frameset | none | iso-8859-1 | D, L, V | 2 frames without title; empty fallback |
| `thepeople/index_main.html` | 3,786 | Flash/Ruffle | none | none | D, L, C, V | missing object end tag |
| `theshed/index.html` | 2,551 | Flash/Ruffle | none | none | D, L, C, V, M | - |
| `theworks/index.html` | 3,165 | Flash/Ruffle | H4 | none | L, C, V | - |
| `theworks/index_old.html` | 1,437 | Flash, no loader | none | none | D, L, C, V, M | - |
| `video1/index.htm` | 1,264 | utility/text | H4 | iso-8859-1 | L, V, M | - |
| `video1/index1.htm` | 2,436 | video | H5 | utf-8 | M | - |
| `video1/index2.htm` | 1,235 | video | H5 | utf-8 | M | - |
| `video1/index3.htm` | 2,576 | Flash/Ruffle | H4 | iso-8859-1 | L, V, M | - |
| `video2/index.htm` | 1,008 | utility/text | H4 | iso-8859-1 | L, V, M | - |
| `video2/index1.htm` | 2,409 | video | H5 | utf-8 | M | - |

## Exact repeated block locations

Whitespace-normalized comparisons of full inline script/style bodies; comments count as content. Script and style tags themselves are excluded. Character counts refer to the first copy before whitespace normalization and may vary with formatting in other copies.

| Kind | Copies | First-copy characters | Locations (file:line) |
|---|---:|---:|---|
| script | 6 | 405 | `comments/index.html:24`; `results/index_main.html:70`; `theartist/index.html:24`; `theshed/index.html:24`; `theworks/index.html:34`; `video1/index3.htm:26` |
| style | 13 | 683 | `comments/index.html:39`; `results/index_main.html:85`; `results/results.html:34`; `scene2/index.htm:41`; `scene3/a2x4popup.html:33`; `theart/index_main.html:78`; `theartist/index.html:39`; `theartist/insp.htm:39`; `theland/index_main.html:78`; `thepeople/index_main.html:71`; `theshed/index.html:39`; `theworks/index.html:49`; `video1/index3.htm:41` |
| script | 3 | 288 | `index-01.html:49`; `index-02.html:49`; `index-03.html:52` |
| style | 3 | 647 | `links/index.html:77`; `scene2/index_new.htm:43`; `scene3/index_main.html:112` |
| script | 12 | 185 | `music.htm:25`; `music2.htm:25`; `music3.htm:26`; `results/results.html:25`; `scene2/index.htm:32`; `scene2/index_new.htm:34`; `scene3/a2x4popup.html:24`; `scene3/credits.html:30`; `scene3/index_main.html:103`; `theart/index_main.html:69`; `theland/index_main.html:69`; `thepeople/index_main.html:62` |
| script | 3 | 378 | `results/index_main.html:39`; `theart/index_main.html:38`; `theland/index_main.html:38` |
| script | 3 | 545 | `results/index_main.html:53`; `theart/index_main.html:52`; `theland/index_main.html:52` |
| script | 3 | 65 | `theart/index_main.html:32`; `theland/index_main.html:32`; `thepeople/index_main.html:25` |
| script | 2 | 1123 | `video1/index1.htm:46`; `video2/index1.htm:45` |

**Byte-identical whole pages:** `scene3/index.html`, `theart/index.html`, `theland/index.html`, `thepeople/index.html`. Each is 1,324 bytes. Their relative URLs resolve within different directories, so identical bytes do not imply interchangeable destination pages. These copies are good template candidates, not candidates for blind URL replacement.

## Archived HTML inventory (10 files, separate from main counts)

These files received source-level inventory and metadata/tag/reference checks. They contain historical variants; no decision to delete or publish them is implied.

| File | Bytes | Title | Source findings |
|---|---:|---|---|
| `backups/index.htm` | 9,549 | shawnsfolkart.com :: Welcome | no doctype; no lang; no viewport; 16 unresolved relative reference targets |
| `backups/index2.htm` | 529 | shawnsfolkart 2026 :: Home | no doctype; no lang; no viewport; 2 unresolved relative reference targets |
| `backups/index_new_bak.htm` | 8,259 | Welcome to Shawn's Folk Art :: Touchwood Design | no doctype; no lang; no viewport; 35 img without alt; 15 unresolved relative reference targets |
| `backups/index_newnew.htm` | 8,295 | Welcome to Shawn's Folk Art :: Touchwood Design | no doctype; no lang; no viewport; 35 img without alt; 16 unresolved relative reference targets |
| `backups/index_old.htm` | 8,867 | Welcome to Shawn's Folk Art :: Touchwood Design | no doctype; no lang; no viewport; 34 img without alt; 16 unresolved relative reference targets |
| `backups/index_real.htm` | 1,336 | TouchwoodDesign ::Splash | no doctype; no lang; no viewport; 3 unresolved relative reference targets |
| `comments/backups/index.html` | 871 | comments | no doctype; no lang; no viewport |
| `scene3/backup/credits_old.html` | 6,982 | Touchwooddesign.com :: Credits | no doctype; no lang; no viewport; 22 unresolved relative reference targets |
| `scene3/backup/index_bak_111701.html` | 1,281 | touchwooddesign.com :: Main | no doctype; no lang; no viewport; 2 unresolved relative reference targets |
| `scene3/backup/index_main_bak_010702.html` | 1,081 | touchwooddesign.com :: Main2 | no doctype; no lang; no viewport; 1 unresolved relative reference targets |

Archive unresolved relative targets (may reflect original directory locations; not evidence to alter active routes):

- `backups/index.htm`: `images/index3/comic_pic1.jpg`, `images/index3/comic_pic2.jpg`, `images/index3/comic_pic3.jpg`, `images/index3/disclaimer_100percent.jpg`, `images/index3/enter_button.jpg`, `images/index3/index_new3_r1_c4_slice.jpg`, `images/index3/index_new3_r1_c5_slice.jpg`, `images/index3/index_new3_r1_c6_slice.jpg`, `images/index3/index_new3_r2_c6_slice.jpg`, `images/index3/index_new3_r2_c9_slice.jpg`, `images/index3/index_new3_r3_c6_slice.jpg`, `images/index3/index_new3_r6_c2_slice.jpg`, `images/index3/requirements.jpg`, `images/index3/shawnsfolkart_logo1.jpg`, `images/index3/shawnsfolkart_logo2.jpg`, `scene2/index.htm`.
- `backups/index2.htm`: `music.htm`, `scene3/index.html`.
- `backups/index_new_bak.htm`: `images/intro/index_r10_c1.gif`, `images/intro/index_r10_c7.gif`, `images/intro/index_r1_c1.gif`, `images/intro/index_r1_c10.gif`, `images/intro/index_r1_c6.gif`, `images/intro/index_r2_c1.gif`, `images/intro/index_r2_c5.gif`, `images/intro/index_r3_c5.gif`, `images/intro/index_r4_c1.gif`, `images/intro/index_r4_c3.gif`, `images/intro/index_r7_c1.gif`, `images/intro/index_r8_c5.gif`, `images/intro/index_r9_c4.gif`, `images/intro/spacer.gif`, `images/intro/tv_mountie.jpg`.
- `backups/index_newnew.htm`: `Dispatcher.js`, `images/intro/index_r10_c1.gif`, `images/intro/index_r10_c7.gif`, `images/intro/index_r1_c1.gif`, `images/intro/index_r1_c10.gif`, `images/intro/index_r1_c6.gif`, `images/intro/index_r2_c1.gif`, `images/intro/index_r2_c5.gif`, `images/intro/index_r3_c5.gif`, `images/intro/index_r4_c1.gif`, `images/intro/index_r4_c3.gif`, `images/intro/index_r7_c1.gif`, `images/intro/index_r8_c5.gif`, `images/intro/index_r9_c4.gif`, `images/intro/spacer.gif`, `images/intro/tv_mountie.jpg`.
- `backups/index_old.htm`: `images/intro/index_r10_c1.gif`, `images/intro/index_r10_c7.gif`, `images/intro/index_r1_c1.gif`, `images/intro/index_r1_c10.gif`, `images/intro/index_r1_c6.gif`, `images/intro/index_r2_c1.gif`, `images/intro/index_r2_c5.gif`, `images/intro/index_r3_c5.gif`, `images/intro/index_r4_c1.gif`, `images/intro/index_r4_c3.gif`, `images/intro/index_r7_c1.gif`, `images/intro/index_r8_c5.gif`, `images/intro/index_r9_c4.gif`, `images/intro/spacer.gif`, `images/intro/tv_mountie.jpg`, `scene2/index_new.htm`.
- `backups/index_real.htm`: `1_openingsoundtrack_old.swf`, `css/master.css`, `flash_1a.swf`.
- `scene3/backup/credits_old.html`: `../favicon/apple-touch-icon.png`, `../favicon/favicon-16x16.png`, `../favicon/favicon-32x32.png`, `../favicon/site.webmanifest`, `images/credits/credits_r1_c1.gif`, `images/credits/credits_r1_c2.gif`, `images/credits/credits_r1_c3.gif`, `images/credits/credits_r2_c1.gif`, `images/credits/credits_r2_c2.gif`, `images/credits/credits_r2_c3.gif`, `images/credits/credits_r3_c1.gif`, `images/credits/credits_r3_c2.gif`, `images/credits/credits_r3_c3.gif`, `images/credits/credits_r4_c1.gif`, `images/credits/credits_r4_c2.gif`, `images/credits/credits_r4_c3.gif`, `images/credits/credits_r5_c1.gif`, `images/credits/credits_r5_c2.gif`, `images/credits/credits_r5_c3.gif`, `images/credits/credits_r6_c1.gif`, `images/credits/credits_r6_c2.gif`, `images/credits/credits_r6_c3.gif`.
- `scene3/backup/index_bak_111701.html`: `4_main2_2.swf`, `main_splash_sound.swf`.
- `scene3/backup/index_main_bak_010702.html`: `4_main2_2.swf`.

## Supplemental HTML-bearing PHP sources

- `music.php`: legacy object markup with movie generation inside commented PHP. No active movie param or embed output is apparent in the inspected source. It is not a drop-in equivalent of the current music pages. No references to music.php were found in the checked HTML/HTM/JS/PHP sources; SWF references were not inspected.
- `comments/submitmail.php` and `scene3/submitmail.php`: both include old image-table confirmation HTML, generator-placeholder description and a Content-Type meta without charset, plus duplicated preload logic. Include these confirmation pages in any later template/content standardization if the endpoints remain in use. The comments UI itself is in a SWF; an absent HTML form on comments/index.html does not prove submission is broken. PHP/mail behavior was not executed or audited.

## Local-reference results and verification boundaries

In the 46-page set, no missing local file targets were found for static relative src/href/background attributes and movie param values after stripping query/fragment suffixes. This check excludes absolute/root-relative URLs, CSS URLs, inline JavaScript strings, preload argument paths, manifest contents and SWF-internal requests. It does not validate fragment IDs or case-sensitive deployment paths. No duplicate id attributes were detected in this set.

The archive table separately lists unresolved references in historical locations. Historical files and variants were retained unchanged.

## Standards references

These references support the recommendations; project counts and defects come from the local source audit.

- [WHATWG: obsolete HTML features](https://html.spec.whatwg.org/multipage/obsolete.html) — frame, frameset and noframes are obsolete; modernization requires structural review.
- [W3C HTML 4.01: frames](https://www.w3.org/TR/html401/present/frames.html) — historical frameset/noframes content model used to assess the current legacy wrappers.
- [MDN: HTML performance optimization](https://developer.mozilla.org/en-US/docs/Learn_web_development/Extensions/Performance/HTML) — resource loading and markup simplification context. Project-specific savings still require measurement.

## Preservation check

A SHA-256 snapshot of every existing project file outside .git/docs was taken immediately before report creation and compared immediately afterward. All existing files matched. The report is the only project file created by this audit; temporary scan measurements were kept outside the project. Pre-existing worktree edits were preserved.
