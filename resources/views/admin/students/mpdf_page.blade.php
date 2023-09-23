<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>{{$title}}</title>
    <style>
      body {
          font-family: 'DejaVu Sans', sans-serif;
      }

      .invoice-box {
          max-width: 800px;
          margin: auto;
          padding: 30px;
          font-size: 9px;
          line-height: 24px;
          font-family: 'DejaVu Sans', sans-serif;
          color: #555;
      }

      .invoice-box table {
          width: 100%;
          line-height: inherit;
          text-align: right;
      }

      .invoice-box table td {
          padding: 5px;
          vertical-align: top;
      }

      .invoice-box table tr td {
          text-align: left;
      }

      .invoice-box table tr.top table td {
          padding-bottom: 20px;
      }

      .invoice-box table tr.top table td.title {
          font-size: 30px;
          line-height: 45px;
          color: #333;
      }

      .invoice-box table tr.information table td {
          padding-bottom: 40px;
      }

      .invoice-box table tr.heading td {
          background: #eee;
          border-bottom: 1px solid #ddd;
          font-weight: bold;
      }

      .invoice-box table tr.details td {
          padding-bottom: 20px;
      }

      .invoice-box table tr.item td{
          border-bottom: 1px solid #eee;
      }

      .invoice-box table tr.item.last td {
          border-bottom: none;
      }

      .invoice-box table tr.total td {
          border-top: 2px solid #eee;
          font-weight: bold;
      }

      @media only screen and (max-width: 600px) {
          .invoice-box table tr.top table td {
              width: 100%;
              display: block;
              text-align: center;
          }

          .invoice-box table tr.information table td {
              width: 100%;
              display: block;
              text-align: center;
          }
      }

      /** RTL **/
      .rtl {
          direction: rtl;
          font-family: 'DejaVu Sans', sans-serif;
      }

      .rtl table {
          text-align: right;
      }

      .rtl table tr td {
          text-align: right;
      }

      @page {
          header: page-header;
          footer: page-footer;
      }
  </style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="https://www.sparksuite.com/images/logo.png" style="width: 100px; max-width: 100px" />
								</td>

								<td>
									<br />
									Faculté: {{$faculty->name_fr}}-{{$faculty->name_ar}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									Sparksuite, Inc.<br />
									12345 Sunny Road<br />
									Sunnyville, CA 12345
								</td>

							
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>

					<td>Check #</td>
				</tr>

				<tr class="details">
					<td>Check</td>

					<td>1000</td>
				</tr>

			</table>
		</div>
	</body>
</html> 
 