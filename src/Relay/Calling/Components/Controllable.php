<?php

namespace SignalWire\Relay\Calling\Components;

use SignalWire\Messages\Execute;

abstract class Controllable extends BaseComponent {

  public function stop() {
    $msg = new Execute([
      'protocol' => $this->call->relayInstance->protocol,
      'method' => "{$this->method()}.stop",
      'params' => [
        'node_id' => $this->call->nodeId,
        'call_id' => $this->call->id,
        'control_id' => $this->controlId
      ]
    ]);

    return $this->call->_execute($msg)->otherwise(function($error) {
      $this->_failure();
      return (object)[
        'code' => $error->getCode(),
        'message' => $error->getMessage()
      ];
    });
  }

}
