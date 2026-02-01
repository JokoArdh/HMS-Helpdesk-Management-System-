<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=	, initial-scale=1.0">
	<title>Halaman | {{ $title }}</title>

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background-color: #CBDCEB;
        }
        h3,h5{
            color: #608BC1;
            font-weight: bold;
        }
        .form-label, .form-check-label{
            color: #608BC1;
        }
        .footer{
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
        }
    </style>

</head>
<body>
    <main>
        <div class="container">
    
          @yield('container')
    
        </div>
    </main>

	<!-- JavaScript Bundle with Popper -->
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
</body>
</html>