<?php class Sfxfilter
{

    public $filters = [];

    public function add(string $name, $cb)
    {
        $this->filters[$name][] = $cb;
    }

    public function run(string $name, $data, $args = [])
    {
        if (!isset($this->filters[$name])) return $data;
        foreach ($this->filters[$name] as $k => $v) {
            if (gettype($v) == "string") {
                $data = $v;
                continue;
            }
            $data = $v($data, $args);
        }
        return $data;
    }
}
