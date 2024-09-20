@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Cập nhật đơn hàng</h5>
  <div class="card-body">
    <form action="{{route('order.update',$order->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="1" {{($order->status=='2' || $order->status=="3" || $order->status=="4") ? 'disabled' : ''}}  {{(($order->status=='new')? 'selected' : '')}}>Chờ xác nhận</option>
          <option value="2"   {{(($order->status=='2')? 'selected' : '')}}>Đã xác nhận</option>
          <option value="3"  {{(($order->status=='3')? 'selected' : '')}}>Đang giao</option>
          <option value="4"   {{(($order->status=='4')? 'selected' : '')}}>Đã giao</option>
          <option value="5"   {{(($order->status=='5')? 'selected' : '')}}>Đã hủy</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush
