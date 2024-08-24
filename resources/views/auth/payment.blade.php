@extends('layout.signin-layout')

@section('contentTitle', 'PAYMENT')

@section('content')
    @if (session('error'))
    <div class="col-lg-10 col-sm-9 col-10 mx-auto my-3 pb-3">
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    </div>
    @endif
    <div class="col-lg-10 col-sm-9 col-10 mx-auto my-3 pb-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-coin me-1"></i><strong>{{ session('regPrice') }}</strong>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('confirmPayment') }}">
        @csrf
        <div class="col-lg-10 col-sm-9 col-10 mx-auto my-3">
            <label for="inputAmount" class="form-label fw-bold">Input Amount</label>
            <input type="text" id="inputAmount" name="inputAmount" class="form-control" aria-describedby="amountHelpBlock" required autofocus>
            <div id="amountHelpBlock" class="form-text">
            Your input must be in numerical 
            </div>
        </div>
        <div class="row col-lg-4 col-md-6 col-sm-8 col-8 mx-auto py-3 g-2">
            <div class="col">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </form>

    @if (session('excessAmount'))
        <div class="modal fade" id="excessAmountModal" tabindex="-1" aria-labelledby="excessAmountModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="excessAmountModalLabel">Amount Exceeds Required Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        You have entered an amount of <strong><i class="bi bi-coin me-1"></i>{{ session('excessAmount') }}</strong> which exceeds the required payment of <strong><i class="bi bi-coin me-1"></i>{{ session('regPrice') }}</strong>.
                        <br><br>
                        Do you want to add the excess to your personal coin?
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('addExcess') }}">
                            @csrf
                            <input type="hidden" name="inputAmount" value="{{ session('regPrice') }}">
                            <button type="submit" class="btn btn-primary">Yes</button>
                        </form>
                        <button type="button" id="noButton" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var myModal = new bootstrap.Modal(document.getElementById('excessAmountModal'), {
                    keyboard: false
                });
                myModal.show();

                document.getElementById('noButton').addEventListener('click', function () {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('excessAmountModal'));
                    modal.hide();

                    window.location.href = "{{ route('home') }}";
                });
            });
        </script>
    @endif
@endsection