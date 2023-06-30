<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TEST LTDEV JUNIOR</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <style >
            .box {
                border: 1px solid #ddd;
                margin: 10px;
                padding: 10px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
            }
            html, body {
                height: 100%;
            }

            body {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h4 class="text-center" id="precioBitcoin"></h4>
                    <div class="box shadow p-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                  <label for="usd">USD:</label>
                                  <input type="number" class="form-control" id="inputUSD">
                                </div>
                                <div class="col-xs-6">
                                  <label for="btc">Bitcoin:</label>
                                  <input type="number" class="form-control" id="inputBTC">
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script defer src="{{asset('script.js')}}""></script>
</html>