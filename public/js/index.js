var alertNode = document.querySelector('#this-alert')
var alert = bootstrap.Alert.getInstance(alertNode)

setTimeout(() => {
    alert.close()
}, 4000);