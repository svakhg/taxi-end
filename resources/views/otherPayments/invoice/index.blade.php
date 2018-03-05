<!DOCTYPE html>
<html lang="en" >

<head>
  	<meta charset="UTF-8">
	<title>Invoice</title>
	<link rel="stylesheet" href="/css/invoice.css">
</head>

<body>
	<header>
		<h1>Invoice</h1>
		<address contenteditable="">
			<p>Hassan Rameez</p>
			<p>Taviyani Pvt Ltd</p>
			<p>Male</p>
			<p>Maldives</p>
			<p>+960 330 2002</p>
		</address>
		<span><img alt="" src="/img/logo/invoice/{{ $company }}.jpg"><input type="file" accept="image/*"></span>
	</header>
	<article>
		<h1>Recipient</h1>
		<address contenteditable>
			<p>Recipient Company<br>c/o Some Guy</p>
		</address>
		<table class="meta">
			<tr>
				<th><span contenteditable>Invoice #</span></th>
				<td><span contenteditable>101138</span></td>
			</tr>
			<tr>
				<th><span contenteditable>Date</span></th>
				<td><span contenteditable>{{ Carbon\Carbon::now()->format('d F Y') }} </span></td>
			</tr>
			<tr>
				<th><span contenteditable>Amount Due</span></th>
				<td><span id="prefix" contenteditable>RF </span><span> 0.00</span></td>
			</tr>
		</table>
		<table class="inventory">
			<thead>
				<tr>
					<th><span contenteditable>Item</span></th>
					<th><span contenteditable>Description</span></th>
					<th><span contenteditable>Rate</span></th>
					<th><span contenteditable>Quantity</span></th>
					<th><span contenteditable>Price</span></th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		<a class="add">+</a>
		<table class="balance">
			<tr>
				<th><span contenteditable>Total</span></th>
				<td><span data-prefix>RF </span><span>0.00</span></td>
			</tr>
			<tr>
				<th><span contenteditable>Amount Paid</span></th>
				<td><span data-prefix>RF </span><span contenteditable>0.00</span></td>
			</tr>
			<tr>
				<th><span contenteditable>Balance Due</span></th>
				<td><span data-prefix>RF </span><span>0.00</span></td>
			</tr>
		</table>
	</article>
	<aside>
		<h1><span contenteditable>Additional Notes</span></h1>
		<div contenteditable>
			<p>Enter any additional notes here</p>
		</div>
	</aside>

	<script  src="/js/invoice.js"></script>
</body>
</html>
