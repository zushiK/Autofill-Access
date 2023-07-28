<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AbstractRepository
{
    /**
     * 継承元でmodelのDIを行う
     *
     * @var Model
     */
    protected $model;


    /**
     * 1件取得
     *
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(string $id)
    {
        $a = $this->model->find($id);
        if (!$a) throw new HttpException(404, "resource not found");
        return $a;
    }

    /**
     * 複数取得
     *
     * @param array[int] $ids
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function some(array $ids)
    {
        return $this->model->whereIn("id", $ids)->get();
    }

    /**
     * フィルタ取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(array $search)
    {
        $qb = $this->model->query();

        $qb = $this->buildOrderQuery($qb, $search);

        return $qb->paginate(30);
    }

    /**
     * build order query
     *
     * @param \Illuminate\Database\Eloquent\Builder $qb
     * @param array $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function buildOrderQuery($qb, $search)
    {
        if (!empty($search["order"]) && !empty($search["orderby"])) {
            $qb->orderBy($search["order"], $search["orderby"]);
        }

        return $qb;
    }

    /**
     * @param array $search
     * @return Builder
     */
    protected function searchQuery(array $search = [])
    {
        $qb = $this->model->query();
        foreach ($search as $k => $v) {
            $qb->where($k, $v);
        }

        return $qb;
    }

    /**
     * @param array $search
     * @return Builder
     */
    protected function searchLikeQuery(array $search = [])
    {
        $qb = $this->model->query();
        foreach ($search as $k => $v) {
            if ($this->model->getAttribute($k)) {
                $qb->where($k, 'like', '%' . $v . '%');
            }
        }

        return $qb;
    }

    /**
     * 全取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll($search = [])
    {
        return $this->buildOrderQuery($this->model->query(), $search)->get();
    }

    /**
     * ページネーション
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginate($perpage)
    {
        return $this->model->paginate($perpage);
    }

    /**
     * 新規作成
     * 戻り値は必ずModelを返すようにする
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->model->create($data);
    }

    /**
     * 1件更新
     * 戻り値は必ずModelを返すようにする
     *
     * @param string $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(string $id, array $data): \Illuminate\Database\Eloquent\Model
    {
        $this->model->where("id", $id)->update($data);
        return $this->model->find($id);
    }

    /**
     * 1件削除
     * 戻り値は必ずModelを返すようにする
     *
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete(string $id): \Illuminate\Database\Eloquent\Model
    {
        $item = $this->model->find($id);
        $item->delete();
        return $item;
    }

    /**
     * アップサート
     *
     * @param array $conditions 条件
     * @param array $data データ
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function upsert(array $conditions, array $data)
    {
        return $this->model->updateOrCreate($conditions, $data);
    }

    /**
     * 次のautoincrementを取得
     *
     * @return int
     */
    public function getNextAutoincrement()
    {
        $sql = "SHOW TABLE STATUS LIKE '" . $this->model->getTable() . "'";
        $result = DB::select($sql);
        return $result[0]->Auto_increment;
    }
}
