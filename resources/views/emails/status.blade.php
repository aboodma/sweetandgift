<h1>{{ translate('Order Updated') }}</h1>
<p>{{ $content }}</p>
<p><b>{{ translate('Sender') }}: </b>{{ $sender }}</p>
<p>
	<b>{{ translate('Details') }}:</b>
	<br>
	@php echo $details; @endphp
</p>
