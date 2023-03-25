<?php

namespace App\WebSockets\Handler;

use BeyondCode\LaravelWebSockets\Apps\App;
use BeyondCode\LaravelWebSockets\QueryParameters;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;
use Illuminate\Support\Facades\Http;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;


class DriverLocationSocketHandler implements MessageComponentInterface
{

    function onMessage(ConnectionInterface $from, MessageInterface $msg)
    {
        $data = json_decode($msg->getPayload(), true);

        Http::post('http://hexaride-admin.6am.one/api/driver/ride/track-location', [
                'user_id' => $data['user_id'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'zone_id' => $data['zone_id']
        ]);
//        if (isset($data['user_id'], $data['latitude'], $data['longitude'], $data['zone_id'])) {
//            $attributes = [
//                'user_id' => $data['user_id'],
//                'type' => 'driver',
//                'latitude' => $data['latitude'],
//                'longitude' => $data['longitude'],
//                'zone_id' => $data['zone_id']
//            ];
//            $this->location->updateOrCreate($attributes);
//
//            dump(('success'));
//        } else {
//            dump(('no valid data provided'));
//        }

        dump($data);

    }

    function onOpen(ConnectionInterface $conn)
    {
        $this
            ->verifyAppKey($conn)
            ->generateSocketId($conn);

    }

    function onClose(ConnectionInterface $conn)
    {
        dump($conn);
        // TODO: Implement onClose() method.
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        dump($e);
        // TODO: Implement onError() method.
    }

    protected function verifyAppKey(ConnectionInterface $connection)
    {
        $appKey = QueryParameters::create($connection->httpRequest)->get('appKey');
        if (! $app = App::findByKey($appKey)) {
            throw new UnknownAppKey($appKey);
        }
        $connection->app = $app;

        return $this;
    }

    protected function generateSocketId(ConnectionInterface $connection)
    {
        $socketId = sprintf('%d.%d', random_int(1, 1000000000), random_int(1, 1000000000));
        $connection->socketId = $socketId;

        return $this;
    }
}

