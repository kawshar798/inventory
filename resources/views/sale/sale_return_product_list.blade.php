

<tr id="pro-data{{$product->id}}">
    <td><p id="proName" class="text-primary">{{$product->name}}</p><input type="hidden" name="proId[]" value="{{$product->id}}"></td>
    <td><input class="form-control qty" type="number" min="0" onchange="proMultiPur({{$product->id}})" id="proQuantity-{{$product->id}}" name="proQuantity[]" value="1"></td>
    <td><input type="number" class="form-control " readonly id="proUnitdiscount-{{$product->id}}"  value="{{$product->discount}}"></td>
    <td><input type="number" class="form-control" readonly id="proUnitPrice-{{$product->id}}"  value="{{$product->cost_price}}"></td>
    <td><input type="number" class="form-control subtotal" readonly id="proSubPrice-{{$product->id}}"  value="{{$product->cost_price}}" name="prosubTotal[]"></td>
    <td><a  onclick="removeProductPur({{$product->id}})" class="kt-nav__link"><i class="fa fa-trash text-danger ibtnDel"></i></a></td>
</tr>
