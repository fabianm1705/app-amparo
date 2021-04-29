function onQRCodeScanned(id)
{
  axios.post('/validar/qr/'+id)
    .then((resp)=>{
      console.log('antes de validar '+resp);
      if (resp) {
        console.log('validado');
        document.getElementById("formOk").submit();
      }
    })
    .catch(function (error) {
      console.log(error);
    })
}

function provideVideo()
{
    var n = navigator;

    if (n.mediaDevices && n.mediaDevices.getUserMedia)
    {
      return n.mediaDevices.getUserMedia({
        video: {
          facingMode: "environment"
        },
        audio: false
      });
    }

    return Promise.reject('El navegador no soporta getUserMedia');
}

function provideVideoQQ()
{
    return navigator.mediaDevices.enumerateDevices()
    .then(function(devices) {
        var exCameras = [];
        devices.forEach(function(device) {
        if (device.kind === 'videoinput') {
          exCameras.push(device.deviceId)
        }
     });

        return Promise.resolve(exCameras);
    }).then(function(ids){
        if(ids.length === 0)
        {
          return Promise.reject('No podemos encontrar una cámara web');
        }

        return navigator.mediaDevices.getUserMedia({
            video: {
              'optional': [{
                'sourceId': ids.length === 1 ? ids[0] : ids[1]//this way QQ browser opens the rear camera
                }]
            }
        });
    });
}

//this function will be called when JsQRScanner is ready to use
function JsQRScannerReady()
{
    //create a new scanner passing to it a callback function that will be invoked when
    //the scanner succesfully scan a QR code
    var jbScanner = new JsQRScanner(onQRCodeScanned);
    //var jbScanner = new JsQRScanner(onQRCodeScanned, provideVideo);
    //reduce the size of analyzed image to increase performance on mobile devices
    jbScanner.setSnapImageMaxSize(300);
  var scannerParentElement = document.getElementById("scanner");
  if(scannerParentElement)
  {
      //append the jbScanner to an existing DOM element
    jbScanner.appendTo(scannerParentElement);
  }
}
