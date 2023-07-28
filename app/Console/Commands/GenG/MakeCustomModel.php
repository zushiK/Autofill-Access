<?php

namespace App\Console\Commands\GenG;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Console\GeneratorCommand as Command;
use Illuminate\Support\Str;

/**
 * https://qiita.com/schrosis/items/8253b38db735f0d20cb7
 */
class MakeCustomModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:custom-model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom-model class';

    protected $type = 'Custom Model';

    /**
     * スタブファイル指定
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('/stubs/model.custom.stub');
    }

    /**
     * クラスのデフォルトの名前空間を取得する
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models';
    }

    /**
     * InputArgumentのコンストラクタへ渡す引数の配列のリストを返します
     *
     * @return array
     */
    // protected function getArguments()
    // {
    //     // GeneratorCommandでクラス名を受け取る引数(name)を定義しているのでマージする
    //     return array_merge(
    //         parent::getArguments(),
    //         [
    //             // InputArgumentのコンストラクタへ渡す引数の配列を追加していく
    //             // ここに引数を表現する配列を追加していく
    //             // 左から
    //             // @param string               $name        引数名
    //             // @param int|null             $mode        引数のモード(self::REQUIREDとself::OPTIONALはどちらか一つ)
    //             // @param string               $description 引数の説明
    //             // @param string|string[]|null $default     引数の初期値(引数のモードにself::OPTIONALを指定している場合のみ)
    //             ['argName', InputArgument::REQUIRED, 'the argument description']

    //         ]
    //     );
    // }

    /**
     * InputOptionのコンストラクタへ渡す引数の配列のリストを返します
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            // InputOptionのコンストラクタへ渡す引数の配列を追加していく
            // 左から
            // @param string                        $name        オプション名
            // @param string|array|null             $shortcut    オプションショートカット
            // @param int|null                      $mode        オプションのモード(self::VALUE_NONEとself::VALUE_REQUIREDとself::VALUE_OPTIONALはどれか一つ)
            // @param string                        $description オプションの説明
            // @param string|string[]|int|bool|null $default     オプションの初期値(オプションのモードにself::VALUE_NONE以外を指定している場合のみ)
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'model'],
        ];
    }

    /**
     * 指定された名前でクラスを構築する
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $s = explode("/", $this->argument("name"));
        $l = array_pop($s);
        $replace = [
            'DummyModel' => $this->argument('name'),
            'DummySnakeModel' => Str::plural(Str::snake((strtolower($l)))),
            'DummyLowerModel' => Str::plural(strtolower($l)),
            'DummyNM' => implode("\\", $s) ? "\\" . implode("\\", $s) : ""
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }
}
