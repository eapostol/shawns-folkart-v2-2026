# Project updates

**Last updated:** 2026-11-24

## 2026-11-24 — Flash Comments submissions

### What changed

- The original Flash Comments form now submits through Formspree. The first local test confirmed email delivery and showed that the legacy Flash POST also sent internal movie variables. The final integration sends only `name`, `email`, `message`, and the reCAPTCHA response token. Formspree uses the visitor’s email address for Reply-To.
- The page validates the three fields before opening a reCAPTCHA v2 Checkbox dialog. Google may ask the visitor to complete an image challenge after they select the checkbox.
- Formspree receives the submission in the background. After Formspree accepts it, Ruffle invokes the original Flash thank-you state on the Comments page. Canceling verification or receiving a submission error leaves the entered values available to edit and retry.
- The Comments page loads an in-memory copy of the original SWF with a two-way JavaScript handoff. The source SWF stays in the repository, and the handoff uses the bundled Ruffle build. The [local handoff test](../comments/handoff-test.html) simulates acceptance, rejection, and cancellation without sending email.

### Verification

The project owner confirmed that the form works locally, on staging, and on production.

| Environment | Where to test | Configuration |
| --- | --- | --- |
| Local | `http://localhost:5500/comments/index.html` | Test reCAPTCHA key and Formspree form |
| Staging | [shawnsfolkart.studio](https://shawnsfolkart.studio/comments/index.html) | Test reCAPTCHA key and Formspree form. The `.dev` domain redirects to `.studio`. |
| Production | [shawnsfolkart.com](https://shawnsfolkart.com/comments/index.html) | Dedicated production reCAPTCHA key and Formspree form |

### Deployment and maintenance

- Upstream `develop` publishes staging. Promote verified changes to upstream `main`, then sync the organization fork’s `main` for production. Preserve `shawnsfolkart.com` in the fork’s `CNAME`.
- The [reCAPTCHA setup guide](recaptcha-v2-setup.md) describes both environments. The site serves the public keys and Formspree endpoints. Each matching secret belongs in its Formspree form’s settings, and private setup worksheets stay outside Git.
- The existing Cloudflare DNS and redirect configuration supports this flow without additional rules.

### Current issues

No open issues were reported for the Comments flow at the time of verification.
