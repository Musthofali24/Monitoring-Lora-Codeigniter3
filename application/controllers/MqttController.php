<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Exceptions\MqttClientException;

class MqttController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_sensor_data($device_id = null)
    {
        $data = $this->SensorModel->get_sensor_data($device_id);
        echo json_encode($data);
    }

    public function listen_mqtt()
    {
        $server = 'broker.hivemq.com';
        $port = 1883;
        $clientId = 'ci3_mqtt_client';

        try {
            echo "Connecting to MQTT broker...\n";
            $mqtt = new MqttClient($server, $port, $clientId);
            $mqtt->connect();
            echo "Connected!\n";
            $mqtt->subscribe('lora_data', function ($topic, $message) {
                $this->process_message($message);
            }, 0);
            $mqtt->loop(true);
        } catch (MqttClientException $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }

    private function process_message($message)
    {
        $data = json_decode($message, true);
        if (isset($data['device_id']) && isset($data['data'])) {
            $device_id = $data['device_id'];
            $sensor_data = $data['data'];
            $this->save_sensor_data($device_id, $sensor_data);
        } else {
            echo "Invalid message format.\n";
        }
    }

    private function save_sensor_data($device_id, $sensor_data)
    {
        $data = [
            'device_id' => $device_id,
            'data' => $sensor_data,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        $this->SensorModel->insert_data($data);
        echo "Data inserted into database.\n";
    }
}
