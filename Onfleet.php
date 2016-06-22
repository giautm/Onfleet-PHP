<?php

/**
 * Onfleet API wrapper (CodeIgniter Library)
 *
 * Onfleet's application programming interface (API) provides the communication link
 * between your application and Onfleet API.
 *
 * @author   Billy Bateman <billy@codekush.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @link     https://github.com/billybateman/Onfleet-PHP
 * @date     2015-07-07
 */
class Onfleet {
    /**
     * Base settings
     */
    private $_apiUrl = '';
    private $_apiKey = '';
    private $_apiName = '';

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
        $this->_apiUrl = rtrim($apiUrl ?: 'https://onfleet.com/api/v2', '/') . '/';
    }

    /**
     * List organizations
     *
     * @return object
     */
    public function organizations() {
        return $this->request('get', 'organization');
    }

    /**
     * Organizations details
     *
     * @param array $params
     * @return object
     */
    public function organization_details($params = []) {
        $id = $params['id'];
        return $this->request('get', 'organizations/' . $id);
    }

    /**
     * List administrators
     *
     * @return object
     */
    public function admins() {
        return $this->request('get', 'admins');
    }

    /**
     * Admin Details
     *
     * @param array $params
     * @return object
     */
    public function admin_details($params = []) {
        $id = $params['id'];
        return $this->request('get', 'admins/' . $id);
    }

    /**
     * Create admin
     *
     * @param array $params
     * @return object
     */
    public function admin_create($params = []) {
        return $this->request('post', 'admins', $params);
    }

    /**
     * Update admin
     *
     * @param array $params
     * @param $id
     * @return object
     */
    public function admin_update($params = [], $id) {
        return $this->request('put', 'admins/' . $id, $params);
    }

    /**
     * Delete admin
     *
     * @param array $params
     * @return object
     */
    public function admin_delete($params = []) {
        $id = $params['id'];

        return $this->request('delete', 'admins/' . $id);
    }

    /**
     * List workers
     *
     * @param array $params
     * @return object
     */
    public function workers($params = []) {
        return $this->request('get', 'workers', $params);
    }

    /**
     * Worker Details
     *
     * @param array $params
     * @return object
     */
    public function worker_details($params = []) {
        $id = $params['id'];
        return $this->request('get', 'workers/' . $id . "?analytics=true", $params);
    }

    /**
     * Create worker
     *
     * @param array $params
     * @return object
     */
    public function worker_create($params = []) {
        return $this->request('post', 'workers', $params);
    }

    /**
     * Update worker
     *
     * @param array $params
     * @return object
     */
    public function worker_update($params = []) {
        $id = $params['id'];
        return $this->request('put', 'workers/' . $id, $params);
    }

    /**
     * Delete worker
     *
     * @param array $params
     * @return object
     */
    public function worker_delete($params = []) {
        $id = $params['id'];
        return $this->request('delete', 'workers/' . $id);
    }

    /**
     * List teams
     *
     * @return object
     */
    public function teams() {
        return $this->request('get', 'teams');
    }

    /**
     * Team Details
     *
     * @param array $params
     * @return object
     */
    public function team_details($params = []) {
        $id = $params['id'];
        return $this->request('get', 'teams/' . $id);
    }


    /**
     * Destination Details
     *
     * @param array $params
     * @return object
     */
    public function destination_details($params = []) {
        $id = $params['id'];

        return $this->request('get', 'destinations/' . $id);
    }

    /**
     * Create destination
     *
     * @param array $params
     * @return object
     */
    public function destination_create($params = []) {
        return $this->request('post', 'destinations', $params);
    }

    /**
     * Recipient Search By Name
     *
     * @param array $params
     * @return object
     */
    public function recipient_search_name($params = []) {
        $name = $params['name'];

        return $this->request('get', 'recipients/name/' . $name);
    }

    /**
     * Recipient Search By Phone
     *
     * @param array $params
     * @return object
     */
    public function recipient_search_phone($params = []) {
        $phone = $params['phone'];
        return $this->request('get', 'recipients/phone/' . $phone);
    }

    /**
     * Recipient details
     *
     * @param array $params
     * @return object
     */
    public function recipient_details($params = []) {
        $id = $params['id'];
        return $this->request('get', 'recipients/' . $id);
    }

    /**
     * Create recipient
     *
     * @param array $params
     * @return object
     */
    public function recipient_create($params = []) {
        return $this->request('post', 'recipients', $params);
    }

    /**
     * Update recipient
     *
     * @param array $params
     * @return object
     */
    public function recipient_update($params = []) {
        $id = $params['id'];
        return $this->request('put', 'recipients/' . $id, $params);
    }

    /**
     * List tasks
     *
     * @param array $params
     * $params['state'] integer (0 = Unnasigned, 1 = Assigned, 2 = Active, 3 = Completed)
     * @return object
     */
    public function tasks($params = []) {
        return $this->request('get', 'tasks', $params);
    }

    /**
     * Task details
     *
     * @param array $params
     * @return object
     */
    public function task_details($params = []) {
        $id = $params['id'];

        return $this->request('get', 'tasks/' . $id);
    }

    /**
     * Create task
     *
     * @param array $params
     * @return object
     */
    public function task_create($params = []) {
        return $this->request('post', 'tasks', $params);
    }

    /**
     * Update task
     *
     * @param array $params
     * @return object
     */
    public function task_update($params = []) {
        $id = $params['id'];

        return $this->request('put', 'tasks/' . $id, $params);
    }

    /**
     * Delete task
     *
     * @param array $params
     * @return object
     */
    public function task_delete($params = []) {
        $id = $params['id'];
        return $this->request('delete', 'tasks/' . $id);
    }

    /**
     * List webhooks
     *
     * @return object
     */
    public function webhooks() {
        return $this->request('get', 'webhooks');
    }

    /**
     * Create webhook
     *
     * $params array
     * $params[url'] string
     * $params['trigger'] integer
     *
     * @param array $params
     * @return object
     */
    public function webhook_create($params = []) {
        return $this->request('post', 'webhooks', $params);
    }

    /**
     * Delete webhook
     *
     * @param array $params
     * @return object
     */
    public function webhook_delete($params = []) {
        $id = $params['id'];
        return $this->request('delete', 'webhooks/' . $id);
    }

    /**
     * request data
     * Connect to API URL
     * @param $method
     * @param $url
     * @param array $params
     * @return mixed
     */
    protected function request($method, $url, $params = []) {
        $paramsJson = json_encode($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_apiUrl . $url);
        if ($method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramsJson);
        } else if ($method == 'put') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramsJson);
        } else if ($method == "delete") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
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