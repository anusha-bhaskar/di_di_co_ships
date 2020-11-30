<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $page_title; ?></title>
	<style>
	.pagination {
	  display: inline-block;
	}

	.pagination a {
	  color: black;
	  float: left;
	  padding: 8px 16px;
	  text-decoration: none;
	}
	
	li.active{
		background-color: #d6d6d6;
	}
	</style>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
 
<div class="container">
	<div class='page-header'>
			<h1><?php echo $page_title; ?></h1>
	</div>