
<tr class="success">
	<td>{{ $product->id }}</td>
	<td>{{ $product->name }} </td>
	<td class="amount">{{ ($amount*$product->price_sale) }}</td>
	<td>{{ $amount }}</td>
	<td>{{ $currentDate }} </td>
	<td>        
		<a href="#" class="remove">   
		    <span class=" glyphicon glyphicon-remove " aria-hidden="true"></span>
		</a>   
	</td>
</tr>
		                            
		                       