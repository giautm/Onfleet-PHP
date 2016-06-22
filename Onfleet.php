<?php

/**
 * Onfleet API wrapper (CodeIgniter Library)
 *
 * Onfleet"s application programming interface (API) provides the communication link
 * between your application and Onfleet API.
 *
 * @author   Billy Bateman <billy@codekush.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @link     https://github.com/billybateman/Onfleet-PHP
 * @date     2015-07-07
 */
class Onfleet {
    const POST = 'post';
    const GET = 'get';
    const PUT = 'put';
    const DELETE = 'delete';

    /**
     * Base settings
     */
    private $_apiUrl = "";
    private $_apiKey = "";
    private $_apiName = "";

    /**
     * initial api construct
     *
     * @param $apiKey
     * @param $apiName
     * @param $apiUrl
     * @internal param array $config
     */
    public function __construct($apiKey, $apiName, $apiUrl = null) {
        $this->_apiKey = $apiKey;
        $this->_apiName = $apiName;
        $this->_apiUrl = rtrim($apiUrl ?: "https://onfleet.com/api/v2", "/") . "/";
    }

    /**
     * List organizations
     *
     * @return object
     */
    public function organizations() {
        return $this->call("organization");
    }

    /**
     * Organizations details
     *
     * @param array $params
     * @return object
     */
    public function organizationDetails($params = []) {
        return $this->call("organizations/{$params['id']}");
    }

    /**
     * List administrators
     *
     * @return object
     */
    public function admins() {
        return $this->call("admins");
    }

    /**
     * Admin Details
     *
     * @param array $params
     * @return object
     */
    public function adminDetails($params = []) {
        return $this->call("admins/{$params['id']}");
    }

    /**
     * Create admin
     *
     * @param array $params
     * @return object
     */
    public function adminCreate($params = []) {
        return $this->call("admins", self::POST, $params);
    }

    /**
     * Update admin
     *
     * @param array $params
     * @return object
     * @internal param $id
     */
    public function adminUpdate($params = []) {
        return $this->call("admins/{$params['id']}", self::PUT, $params);
    }

    /**
     * Delete admin
     *
     * @param array $params
     * @return object
     */
    public function adminDelete($params = []) {
        return $this->call("admins/{$params['id']}", self::DELETE);
    }

    /**
     * List workers
     *
     * @param array $params
     * @return object
     */
    public function workers($params = []) {
        return $this->call("workers", $params);
    }

    /**
     * Worker Details
     *
     * @param array $params
     * @return object
     */
    public function workerDetails($params = []) {
        return $this->call("workers/{$params['id']}?analytics=true", $params);
    }

    /**
     * Create worker
     *
     * @param array $params
     * @return object
     */
    public function workerCreate($params = []) {
        return $this->call("workers", self::POST, $params);
    }

    /**
     * Update worker
     *
     * @param array $params
     * @return object
     */
    public function workerUpdate($params = []) {
        return $this->call("workers/{$params['id']}", self::PUT, $params);
    }

    /**
     * Delete worker
     *
     * @param array $params
     * @return object
     */
    public function workerDelete($params = []) {
        return $this->call("workers/{$params['id']}", self::DELETE);
    }

    /**
     * List teams
     *
     * @return object
     */
    public function teams() {
        return $this->call("teams");
    }

    /**
     * Team Details
     *
     * @param array $params
     * @return object
     */
    public function teamDetails($params = []) {
        return $this->call("teams/{$params['id']}");
    }


    /**
     * Destination Details
     *
     * @param array $params
     * @return object
     */
    public function destinationDetails($params = []) {
        return $this->call("destinations/{$params['id']}");
    }

    /**
     * Create destination
     *
     * @param array $params
     * @return object
     */
    public function destinationCreate($params = []) {
        return $this->call("destinations", self::POST, $params);
    }

    /**
     * Recipient Search By Name
     *
     * @param $name
     * @return object
     * @internal param array $params
     */
    public function recipientSearchName($name) {
        return $this->call("recipients/name/{$name}");
    }

    /**
     * Recipient Search By Phone
     *
     * @param $phone
     * @return object
     * @internal param array $params
     */
    public function recipientSearchPhone($phone) {
        return $this->call("recipients/phone/{$phone}");
    }

    /**
     * Recipient details
     * @param $params
     * @return object
     * @internal param $id
     * @internal param array $params
     */
    public function recipientDetails($params) {
        return $this->call("recipients/{$params['id']}");
    }

    /**
     * Create recipient
     *
     * @param array $params
     * @return object
     */
    public function recipientCreate($params = []) {
        return $this->call("recipients", self::POST, $params);
    }

    /**
     * Update recipient
     *
     * @param array $params
     * @return object
     */
    public function recipientUpdate($params = []) {
        return $this->call("recipients/{$params['id']}", self::PUT, $params);
    }

    /**
     * List tasks
     *
     * @param array $params
     * $params["state"] integer (0 = Unnasigned, 1 = Assigned, 2 = Active, 3 = Completed)
     * @return object
     */
    public function tasks($params = []) {
        return $this->call("tasks", $params);
    }

    /**
     * Task details
     *
     * @param array $params
     * @return object
     */
    public function taskDetails($params) {
        return $this->call("tasks/{$params['id']}");
    }

    /**
     * Create task
     *
     * @param array $params
     * @return object
     */
    public function taskCreate($params) {
        return $this->call("tasks", self::POST, $params);
    }

    /**
     * Update task
     *
     * @param array $params
     * @return object
     */
    public function taskUpdate($params) {
        return $this->call("tasks/{$params['id']}", self::PUT, $params);
    }

    /**
     * Delete task
     *
     * @param array $params
     * @return object
     */
    public function taskDelete($params) {
        return $this->call("tasks/{$params['id']}", self::DELETE);
    }

    /**
     * List webhooks
     *
     * @return object
     */
    public function webhooks() {
        return $this->call("webhooks");
    }

    /**
     * Create webhook
     *
     * $params array
     * $params[url"] string
     * $params["trigger"] integer
     *
     * @param array $params
     * @return object
     */
    public function webhookCreate($params = []) {
        return $this->call("webhooks", self::POST, $params);
    }

    /**
     * Delete webhook
     *
     * @param array $params
     * @return object
     */
    public function webhookDelete($params = []) {
        return $this->call("webhooks/{$params['id']}", self::DELETE);
    }

    /**
     * request data
     * Connect to API URL
     * @param $method
     * @param $url
     * @param array $params
     * @return mixed
     */
    protected function call($url, $method = "get", $params = []) {
        $paramsJson = json_encode($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_apiUrl . $url);
        if ($method == self::POST) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramsJson);
        } else if ($method == self::PUT) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::PUT);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramsJson);
        } else if ($method == self::DELETE) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::DELETE);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, "{$this->_apiKey}:");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $output = curl_exec($ch);
        curl_getinfo($ch);
        curl_close($ch);

        return $output;
    }
}