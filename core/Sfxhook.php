<?php class Sfxhook
{

    public $hooks = [];
    public $hooksCb = [];


    public function add(string $name, $cb, $priority = 1)
    {

        $cbName = $cb;
        if (gettype($cbName) != "string") {
            $index = (!isset($this->hooks[$name])) ? 0 : count($this->hooks[$name]);
            $cbName = "{$name}_anonymous_{$index}";
        }

        $this->hooks[$name][$cbName] = $priority;
        $this->hooksCb[$name][$cbName] = $cb;
    }

    public function run(string $name, $args = [])
    {
        if (!isset($this->hooks[$name])) return;
        arsort($this->hooks[$name]);
        // print_r($this->hooksCb[$name]);
        foreach ($this->hooks[$name] as $k => $v) {
            if (!is_callable($this->hooksCb[$name][$k])) continue;
            call_user_func_array($this->hooksCb[$name][$k], ["args" => $args]);
        }
    }
}
