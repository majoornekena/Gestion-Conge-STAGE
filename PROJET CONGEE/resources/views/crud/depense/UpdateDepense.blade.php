<?php
use App\FormatNumber;
use App\FormatDate;
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title>Modifier une dépense</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo asset('assets/plugins/bootstrap/bootstrap.min.css'); ?>">
	<!-- themefy-icon -->
	<link rel="stylesheet" href="<?php echo asset('assets/plugins/themify-icons/themify-icons.css'); ?>">
	<!--Favicon-->
	<link rel="icon" href="<?php echo asset('assets/images/favicon.png" type="image/x-icon'); ?>">
	<!-- fonts -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<!-- Main Stylesheet -->
	<link href="<?php echo asset('assets/assets/style.css'); ?>" rel="stylesheet" media="screen" />
</head>

<body id="page-top">
	<!-- header -->
	@include('template2.Header')
	<!-- /header -->
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<form action="{{ url('/Update_DEPENSE') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="iddepense" value="{{ $depense->iddepense }}">
					<div class="mb-3">
						<label for="idtypedepense" class="form-label">Type de dépense:</label>
						<select name="idtypedepense" id="idtypedepense" class="form-control">
							@foreach($typedepense as $td)
							<option value="{{ $td->idtypedepense }}" {{ $td->idtypedepense == $depense->idtypedepense ? 'selected' : '' }}>{{ $td->typedepense }}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-3">
						<label for="datedepense" class="form-label">Date de la dépense:</label>
						<input type="date" name="datedepense" class="form-control" id="datedepense" value="{{ $depense->datedepense }}">
					</div>
					<div class="mb-3">
						<label for="montant" class="form-label">Montant:</label>
						<input type="number" step="0.01" name="montant" class="form-control" id="montant" value="{{ $depense->montant }}">
					</div>
					<div class="mb-3">
						<label for="quantite" class="form-label">Quantité:</label>
						<input type="number" step="0.01" name="quantite" class="form-control" id="quantite" value="{{ $depense->quantite }}">
					</div>
					<button type="submit" class="btn btn-primary">Modifier</button>
				</form>
			</div>
		</div>
	</div>

	<!-- ** JS assets/plugins Needed for the Project ** -->
	<!-- jquiry -->
	<script src="<?php echo asset('assets/plugins/jquery/jquery-1.12.4.js'); ?>"></script>
	<!-- Bootstrap JS -->
	<script src="<?php echo asset('assets/plugins/bootstrap/bootstrap.min.js'); ?>"></script>
	<!-- match-height JS -->
	<script src="<?php echo asset('assets/plugins/match-height/jquery.matchHeight-min.js'); ?>"></script>
	<!-- Main Script -->
	<script src="<?php echo asset('assets/assets/script.js'); ?>"></script>
</body>

</html>
