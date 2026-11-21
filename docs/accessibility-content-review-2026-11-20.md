# Accessibility/content recommendations — 2026-11-20

Review only. No site code was changed. Recommendations preserve the original artwork, wording, interactions, quirks and period character. Shared-code extraction is deferred until the pages are consistent.

Scope: the same 46 HTML/HTM pages outside archive directories used in the original audit. Archived HTML and PHP output are outside this list. Current source was rescanned after document-consistency changes, so line numbers supersede the original audit. Images already containing an empty alt attribute are not counted as missing.

## Missing image alt attributes

**36 image occurrences on two pages:** 1 on advert/index1.htm and 35 on scene3/index_newnew.htm. They reference 16 distinct image files. Source context and the 15 non-spacer image files were visually inspected. Blank slices are blank artwork, not missing assets.

Four image occurrences carry distinct content or link purpose; 32 are spacers/decorative slices, including the redundant unlinked Enter arrow. An explicit `alt=""` is the recommendation for decorative occurrences. Do not use filenames, “spacer”, or “decorative image” as their spoken text.

### Non-spacer images: complete list

Image paths below are relative to the project root. Page line numbers point to the img opening tag.

| Page and line | Image | Recommended alt value | Reason |
|---|---|---|---|
| `advert/index1.htm:31` | `advert/downeast.jpg` | It Came from the Backyard! — Shawn M. folk art exhibition, DownEast Gallery, Toronto, November 2–29, 2002. | Informative exhibition poster. Pair this short alternative with a separate transcript of the remaining poster text if full equivalent content is added. |
| `scene3/index_newnew.htm:187` | `images/intro/index_r1_c1.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |
| `scene3/index_newnew.htm:197` | `images/intro/index_r1_c6.gif` | Shawn's Folk Art | Site name rendered as lettering. |
| `scene3/index_newnew.htm:207` | `images/intro/index_r1_c10.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |
| `scene3/index_newnew.htm:230` | `images/intro/index_r2_c1.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |
| `scene3/index_newnew.htm:245` | `images/intro/tv_mountie.jpg` | Enter Shawn's Folk Art | Functional linked image: the television/Mountie leads to ../scene2/index_new.htm. Its accessible name should explain the action. |
| `scene3/index_newnew.htm:259` | `images/intro/index_r2_c5.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |
| `scene3/index_newnew.htm:282` | `images/intro/index_r3_c5.gif` | To visit me and my friends you will need a Macromedia Flash plug-in. You can download the latest version here. Click on the TV to continue. | Historical wording in the image. The image map has a separately named Flash-download area; preserve distinct naming of the whole image and its link. |
| `scene3/index_newnew.htm:306` | `images/intro/index_r4_c1.gif` | `alt=""` | Decorative, unlinked Enter arrow pointing toward the TV link. The named TV link already communicates how to enter; the arrow does not need a second spoken instruction. |
| `scene3/index_newnew.htm:316` | `images/intro/index_r4_c3.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |
| `scene3/index_newnew.htm:365` | `images/intro/index_r7_c1.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |
| `scene3/index_newnew.htm:388` | `images/intro/index_r8_c5.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |
| `scene3/index_newnew.htm:411` | `images/intro/index_r9_c4.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |
| `scene3/index_newnew.htm:434` | `images/intro/index_r10_c1.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |
| `scene3/index_newnew.htm:446` | `images/intro/index_r10_c7.gif` | `alt=""` | Blank/near-blank white slice used only to assemble the original table artwork. |

### Spacer image: every occurrence

All 21 occurrences use `images/intro/spacer.gif` (source URL `../images/intro/spacer.gif`) on `scene3/index_newnew.htm`. Recommend **alt="" for each**, preserving all existing dimensions and table markup.

| Page | img opening-tag lines | Recommendation |
|---|---|---|
| `scene3/index_newnew.htm` | 84, 93, 102, 111, 120, 129, 138, 147, 156, 165, 174, 217, 269, 293, 326, 339, 352, 375, 398, 421, 456 | `alt=""` on all 21 occurrences |

### Content qualifications

- **Poster:** the proposed alternative uses the readable title, venue, city and exhibition dates. A fuller transcript could also retain “A celebration of garbage day”, “a retrospective of Urban Artist Shawn M.”, “508 Bathurst Street, Toronto, Canada”, and the “Folk O' Rama” wording. Keep these as historical exhibition details, not a current event listing. This would supplement the image rather than redesign it.
- **Flash instruction image:** the proposed text intentionally reflects the preserved artwork's old instructions. It is historical content, not a recommendation to install an obsolete Flash plug-in today. A separate small preservation note can explain that the site uses Ruffle in modern browsers. Keep the existing image-map link behavior under separate review; changing alt does not repair its old external destination.
- **Enter arrow:** it is an unlinked visual cue beside the linked TV. Empty alt avoids announcing the same instruction twice. If its role changes, reconsider that choice.
- **Image map:** the map area already has alt/title text. Naming the image does not replace or remove the need to name each interactive area.

These recommendations follow W3C guidance for [decorative images](https://www.w3.org/WAI/tutorials/images/decorative/) and [functional images](https://www.w3.org/WAI/tutorials/images/functional/).

## The two unlabeled textareas

Both are in `links/translator.htm`. They are missing associated label elements, rather than a literal label attribute on textarea. The `name` attributes identify fields to JavaScript but do not provide accessible labels.

| Page and line | Existing field | Recommended label text | Suggested association |
|---|---|---|---|
| `links/translator.htm:97` | `textarea name="input"` | Enter your variables | `label for="translator-input"` and `textarea id="translator-input"` |
| `links/translator.htm:116` | `textarea name="output"` | Translation result | `label for="translator-output"` and `textarea id="translator-output"` |

For the input, reuse the existing visible words “Enter your variables” as the label so the presentation can stay the same. For the output, a small visible label would be clearest; if exact layout preservation is required, use an associated visually hidden label that remains accessible to screen readers. Do not hide it with display:none or visibility:hidden.

Keep `name="input"`, `name="output"` and `form name="theForm"` unchanged: translate1/translate2 access those names. The output supports both translation directions, so “Translation result” is more accurate than calling it only “Flash code”. No change to editability or translation actions is proposed here. See [W3C: labeling controls](https://www.w3.org/WAI/tutorials/forms/labels/).

## What useful fallback content/navigation means

A fallback is a small HTML route that lets visitors understand where they are and continue when the normal experience cannot be used: scripts disabled, a redirect failing, the Ruffle runtime failing to load, a movie unsupported, or the visual player inaccessible to a visitor. It does not replace the original design or promise an HTML recreation of every SWF interaction.

“Useful” means giving a page name, a brief description of the experience/content, and ordinary descriptive links with real href destinations. A notice such as “Flash required” or a dead plug-in download link does not help someone continue. A raw SWF download also does not by itself supply accessible content or modern-browser playback.

### Entry page: index.html

Keep the current random redirect and its no-consecutive-repeat behavior. Add a short ordinary HTML body that remains available if the redirect does not run. Suggested copy:

> Welcome to Shawn's Folk Art, a preserved early-web experience. If the opening page has not appeared, choose an entrance below.

The three real destinations already exist: `index-01.html`, `index-02.html`, `index-03.html`. Descriptive link text can be “Entrance 1”, “Entrance 2”, “Entrance 3”. Optionally link directly to `scene3/index.html` as “Main menu”. Ordinary body links cover both disabled scripts and an enabled script that fails. A noscript notice can explain disabled JavaScript, but putting every recovery link only in noscript would not cover runtime errors with JavaScript enabled. A successful redirect normally leaves this body behind before visitors interact with it.

### Flash pages: optional HTML route outside the player

Recommended preservation-friendly method:

1. Leave the original SWF/Ruffle stage and artwork intact.
2. Provide a modest ordinary link outside the player, such as “Text navigation / About this preserved site”, opening a proposed new simple HTML companion page. Alternatively, include a compact HTML navigation block below the stage. Do not overlay the artwork or place navigation inside the fixed-size player container.
3. Include the current section name, a short description, and links to the main sections on that companion page/block. Example: “The Art — Shawn's folk art gallery, presented in its original interactive format.” Use content grounded in the relevant section; inspect movie content before writing detailed descriptions or claiming complete equivalents.
4. Keep the navigation route accessible even when Ruffle fails. An optional player error message can point to it, but a timeout alone cannot establish that playback failed.

Suggested existing targets to verify in implementation:

| Link text | Destination from site root | Qualification |
|---|---|---|
| Main menu | `scene3/index.html` | Flash-based experience; include direct section links too so retrying a broken menu is not the only option. |
| The Art | `theart/index.html` | Wrapper route preserves frame/music behavior. |
| The Land | `theland/index.html` | Wrapper route preserves frame/music behavior. |
| The People | `thepeople/index.html` | Wrapper route preserves frame/music behavior. |
| The Artist | `theartist/index.html` | Content still depends on its player. |
| The Works | `theworks/index.html` | Content still depends on its player. |
| The Shed | `theshed/index.html` | Content still depends on its player. |
| Videos | `video1/index.htm`, `video2/index.htm` | HTML menu pages; native MP4 player pages offer routes outside Flash. |

A new companion page is a proposal, not an existing route. If navigation lives inside a framed content page, links to wrapper pages should target `_top` so they do not nest frames. Use correct relative paths for the page's directory. Avoid using `index_main.html` as a supposedly frame-free alternative: existing frame guards can send it back to its wrapper.

### Why noscript/object/noframes alone are insufficient

- noscript content is for disabled/unsupported scripts. It does not become visible merely because Ruffle fails with scripts enabled.
- Text nested inside object can help native object fallback, but Ruffle replaces/emulates legacy objects. Its behavior must be verified; it should not be the only recovery path.
- noframes is relevant to missing/disabled frame support, not to a failed movie in a browser that supports frames. Existing frame guards also need consideration before adding a frame-free destination.

The most reliable small addition is an ordinary HTML navigation link outside the player, available to keyboard/screen-reader users and visitors with a broken player. Keep it visually quiet; it should not be display:none or dependent on the failing runtime. The destination can provide a simple static route map, preservation context and selected text/image equivalents while the main page retains its period appearance.

This supplies navigation and context, not full access to all Flash-only artwork or interactions. Fuller alternatives would be a later, separately scoped content task. No Flash behavior, artwork, layout, scripts or shared-code organization has been changed.
