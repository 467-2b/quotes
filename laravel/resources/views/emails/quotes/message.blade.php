@component('mail::message')
# Hello {{ $quote->customer->name }},

Your quote is ready!

---
## Line items

| Description   | Price    | Quantity    | Subtotal    |
|:--------------|---------:|------------:|------------:|
@foreach($quote->line_items as $line_item)
| {{$line_item->description}} | ${{ number_format($line_item->price, 2) }} | {{ $line_item->quantity }} | ${{ number_format($line_item->subtotal, 2) }} |
@endforeach
| Items total | | | ${{ number_format($quote->total_amount, 2) }} |
@if($quote->discount_percent != 0)
| {{ $quote->discount_percent * 100 }}% discount | | | ({{ $quote->total_amount * $quote->discount_percent }}) |
@endif
@if($quote->discount_amount != 0)
| Discount | | | (${{ number_format($quote->discount_amount, 2) }}) |
@endif
| Total | | | ${{ number_format($quote->final_total_amount_after_discounts, 2) }} |

---

## Notes
@foreach($quote->notes->where('secret', false) as $note)
> {{ $note->text }}

@endforeach

---

We look forward to doing business with you!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
