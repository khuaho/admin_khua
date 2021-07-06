<?php
return [
    'client_id' => 'AVs6emlYTj20GrCjTil23elsfYYM7VPi3N0CNvPdEPQWASZV7WfAVng0RBdSeMPteuyU90tmrwhCWs2D',
	'secret' => 'EKw9s0YcYwFxjWBnZ6iE_f242OVA1_BwmRI5MSspD-_BOIvSGdItFCEvw6sTYuc8lRqnO8qEpT3EyKQE',
    'settings' => array(
        'mode' => 'sandbox',
        'http.ConnectionTimeOut' => 1000,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'FINE'
    ),
];
