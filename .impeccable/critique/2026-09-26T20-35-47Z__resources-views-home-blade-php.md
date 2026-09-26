---
target: Homepage and callback journey
total_score: 23
max_score: 36
na_heuristics: 7
p0_count: 0
p1_count: 2
target_identity: "file:/Users/ibe/Projects/MassLimo-Connect/resources/views/home.blade.php"
target_fingerprint: "sha256:566aba8c4efa81f11312ed3fc3688725a25cfa3c1f3dfc159d5e37e49c8811b1"
target_path: /Users/ibe/Projects/MassLimo-Connect/resources/views/home.blade.php
timestamp: 2026-09-26T20-35-47Z
slug: resources-views-home-blade-php
---
Method: dual-agent (A: /root/design_review · B: /root/detector_review)

Target: resources/views/home.blade.php, with the callback and confirmation journey.

Design verdict: The site looks coherent and premium, but its strongest identity is still generic luxury transport. The biggest opportunity is to make the referral process clearer and the callback experience more reassuring.

| Heuristic | Score / 4 | Finding |
|---|---:|---|
| System status | 2 | Confirmation leaves follow-up uncertain. |
| Real-world language | 3 | Familiar trip categories; abstract headline. |
| User control | 3 | Calling and callback alternatives; normal navigation. |
| Consistency | 3 | Cohesive styling; decorative arrows imply links. |
| Error prevention | 2 | Basic validation; optionality unclear. |
| Recognition | 3 | Visible, labeled actions and fields. |
| Efficiency | n/a | Not a repeat expert workflow. |
| Minimalist design | 3 | Clear hierarchy, but repetitive copy and excess length. |
| Error recovery | 2 | Values preserved; field errors lack associations. |
| Help | 2 | FAQ exists; callback expectations remain vague. |
| Total | 23/36 | 64% — Acceptable; significant improvements warranted. |

What works:
- Forest green, gold, vehicle photography and restrained typography create a consistent premium impression.
- The mobile call button keeps the primary action reachable. No horizontal overflow was observed on clean tested pages at 390px.
- Referral disclosures, native controls, labels and a skip link provide a useful foundation.

Priority issues:
1. P1 — Callback expectations are unclear. The confirmation says a provider “can contact you” and the request is “on its way,” without establishing the next step. In resources/views/leads/create.blade.php:4 and resources/views/leads/thanks.blade.php:4, state confirmed receipt separately from dispatch, identify who follows up, and use only verified response expectations. Suggested command: impeccable clarify.
2. P1 — Form errors promise nonexistent highlighting. resources/views/leads/create.blade.php:6-8 says to check highlighted fields, but has no per-field errors, aria-invalid or message associations. Add linked summary errors, inline messages and clear invalid states while preserving entered values. Suggested command: impeccable harden.
3. P2 — The mobile callback form starts too low and feels more demanding than it is. At 390px, the first field starts roughly 640–664px down; ten fields appear without meaningful grouping. Compact the heading, group contact/trip details, and consistently mark optional date, time, passenger and additional-detail inputs. Suggested commands: impeccable layout and impeccable distill.
4. P2 — Repeated luxury slogans dilute the concrete offer. resources/views/home.blade.php repeats journey/connection language across a roughly 5,324px mobile page. Make the Massachusetts referral purpose explicit and replace one promotional block with verified referral steps. Tighten mobile service cards. Suggested command: impeccable clarify.
5. P2 — Small supporting text and one measured contrast failure weaken readability. The CTA eyebrow at resources/views/home.blade.php:32 has #6b5128 text on #d7b679, measured at 3.8:1, below 4.5:1 for small text. Numerous supporting labels measure 8.8–11.2px. Increase useful label sizes and darken the CTA eyebrow. Suggested command: impeccable typeset.

Detector evidence:
Static scans returned zero findings for home.blade.php and resources/views/leads. The rendered browser detector reported 24 grouped findings on desktop home, 3 on callback, 3 on confirmation, and 8 on mobile callback. These counts include stylistic flags and false positives; they are not counts of confirmed defects. Closed-menu occlusion and overflow introduced by detector overlays were excluded. Instrument Sans, italic serif accents, uppercase labels and repeated kickers are style signals, not inherently errors. The measured contrast failure and small text are actionable.

Cognitive load and emotional journey:
The callback flow has moderate load: ten fields are ungrouped and optional extras are all shown. The service dropdown's seven options and mobile navigation's five links are conventional contained choices, not seven competing primary actions. The experience moves from premium confidence to form friction, then an uncertain next step.

Persona red flags:
- First-time visitor: may not know what submitting a request commits the provider to.
- Distracted mobile traveler: must scroll through a large introduction and unclear optional fields.
- Keyboard/screen-reader user: lacks explicit field-error associations. Source reviewed; a screen-reader session was not performed.

Minor observations:
- Static city rows and photo caption arrows resemble links. Remove the affordance or make navigation real.
- Consider identifying the stock vehicle as illustrative.
- Confirm broad coverage claims with the business; do not invent testimonials, prices, credentials or guarantees.

Questions to consider:
- What can the business actually promise after a callback request?
- Should the first screen explain the local referral offer more directly than the current slogan?
