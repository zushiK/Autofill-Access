<?php

namespace App\Services;

use App\Repositories\Repository;

class AbstractService
{
    /**
     * 継承元でrepositoryのDIを行う
     *
     * @var Repository
     */
    protected $repository;

    /**
     * idから一つ取得
     *
     * @param string $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(string $id)
    {
        return $this->repository->find($id);
    }

    /**
     * idから複数取得取得
     *
     * @param array $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function some(array $ids)
    {
        return $this->repository->some($ids);
    }

    /**
     * 全件取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll($search = [])
    {
        return $this->repository->getAll($search);
    }

    /**
     * ページネーション
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginate($perpage)
    {
        return $this->repository->paginate($perpage);
    }

    /**
     * 検索
     *
     * @param array $search
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($search, $count = 30)
    {
        return $this->repository->search($search, $count);
    }

    /**
     * 新規作成
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * 更新
     *
     * @param string $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(string $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * 削除
     *
     * @param string $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }

    /**
     * アップサート
     * todo ログ処理入れてないので使うときは注意
     *
     * @param array $conditions 条件
     * @param array $data データ
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function upsert(array $conditions, array $data)
    {
        return $this->repository->upsert($conditions, $data);
    }

    /**
     * 次のautoincrementを取得
     *
     * @return int
     */
    public function getNextAutoincrement()
    {
        return $this->repository->getNextAutoincrement();
    }
}
