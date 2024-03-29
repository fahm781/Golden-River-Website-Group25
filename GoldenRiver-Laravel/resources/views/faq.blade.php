@extends('partials.nav')

@section('css')
<link rel="stylesheet" href="{{asset('css/faq.css')}}">
<title>GoldenRiver | FAQ</title>
@endsection


@section('body')
<body>
	<section class="accordion">
		<div class="accordion-item">
			<div class="accordion-header">
				<span class="icon">&#9660;</span>
				<h3>What warranties do you offer?</h3>
			</div>
			<div class="accordion-content">
				<p>Our warranty policy covers all of the jewelry purchased from Golden River Jewelers. This warranty covers all manufacturer defects in material or workmanship but does not cover neglect and abuse, natural wear and tear or stone loss over .20cts (this gets covered by your insurance).</p>
			</div>
		</div>
		<div class="accordion-item">
			<div class="accordion-header">
				<span class="icon">&#9660;</span>
				<h3>What payment methods do you accept?</h3>
			</div>
			<div class="accordion-content">
				<p>We accept all major credit cards, including Visa, Mastercard, and American Express. We also accept PayPal and bank transfer.</p>
			</div>
		</div>
		<div class="accordion-item">
			<div class="accordion-header">
				<span class="icon">&#9660;</span>
				<h3>What is your return policy?</h3>
			</div>
			<div class="accordion-content">
				<p>We offer a 30-day return policy for all items that are in their original condition and packaging. To initiate a return, please contact our customer service team.</p>
			</div>
		</div>
		<div class="accordion-item">
			<div class="accordion-header">
				<span class="icon">&#9660;</span>
				<h3>How long does shipping take?</h3>
			</div>
			<div class="accordion-content">
				<p>Shipping typically takes 3-5 business days for orders within the United Kingdom. International shipping times may vary depending on the destination.</p>
			</div>
		</div>
	</section>
	<script src="public/js/components/faq.js"></script>
</body>
<script>const accordionItems = document.querySelectorAll('.accordion-item');

    accordionItems.forEach(item => {
      const header = item.querySelector('.accordion-header');
      const icon = header.querySelector('.icon');
      const content = item.querySelector('.accordion-content');
    
      // Hide accordion content on page load
      content.style.display = 'none';
    
      header.addEventListener('click', () => {
        // Toggle active class on accordion item
        item.classList.toggle('active');
    
        // Toggle icon rotation on accordion header
        icon.classList.toggle('rotate');
    
        // Toggle display of accordion content
        if (content.style.display === 'block') {
          content.style.display = 'none';
        } else {
          content.style.display = 'block';
        }
      });
    });
    </script>
@endsection
</html>