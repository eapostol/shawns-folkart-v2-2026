# Accessibility/content changes — 2026-11-20

## Completed

- Added alt attributes to all 35 images in scene3/index_newnew.htm: 21 spacers plus 11 decorative slices/arrows use empty alternatives; the site-name image, linked television image and historical instruction image have descriptive alternatives.
- index_r1_c6.gif: `Shawn's Folk Art`.
- tv_mountie.jpg: `Enter Shawn's Folk Art`.
- The Enter arrow is named index_r4_c1.gif in the source (rather than image_r4_c1.gif); it now has an empty alternative.
- index_r3_c5.gif retains this historical wording as its alternative: `To visit me and my friends you will need a Macromedia Flash plug-in. You can download the latest version here. Click on the TV to continue.`
- Associated the existing visible Enter your variables text with translator-input in links/translator.htm. Added an associated, visually hidden Translation result label for translator-output to preserve the visual layout. Existing form/field names and translation scripts were retained.
- The user's poster alternative in advert/index1.htm was preserved. This is the existing advertisement page; advert/index.html does not exist in this checkout.

## Deferred for a later review

- Preservation note explaining the historical Flash instructions and modern Ruffle playback.
- Useful fallback content/navigation for the entry page, Flash pages and frame wrappers, including any optional HTML companion page or navigation outside the player.
- Shared-code extraction and componentization remain deferred while consistency work continues.

These deferred items are recorded here only; no preservation note or fallback navigation was added to the site. The earlier accessibility-content-review-2026-11-20.md remains the recommendation snapshot from before implementation.

## Verification

- Parsed image markup confirms 35 images have alternatives, including all 21 spacer occurrences; 32 alternatives are empty and three are descriptive.
- Source comparison confirms only the new image alternatives were added to the scene page; image-map alternatives and other markup were preserved.
- Chrome's accessibility tree exposes both textareas as named textboxes: Enter your variables and Translation result.
- Before/after Chrome geometry measurements for both textareas are identical. Both translation functions return the same results as before for the same representative input; this confirms behavior preservation, not a general correctness audit of the legacy translator.
- Translation script source is unchanged. Hash checks confirmed other code files, including the user's advertisement edit, were unchanged by this task.
