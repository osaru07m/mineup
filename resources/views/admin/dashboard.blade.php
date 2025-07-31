<?php


?>
<x-layout title="ダッシュボード">
    <h2>ダッシュボード</h2>
    <div class="row g-2">
        <div class="col-12 col-lg-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <h3 class="card-title">ユーザー</h3>
                    <div class="overflow-y-scroll mb-2" style="max-height: 450px;">
                        <div class="table-responsive">
                            <table class="table table-hover text-center align-middle mb-0">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">ステータス</th>
                                        <th scope="col">ユーザー数</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">アクティブ</td>
                                        <td>{{ number_format($userCount[User::STATUS_ACTIVE] ?? 0) }} 人</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">承認待ち</td>
                                        <td>{{ number_format($userCount[User::STATUS_PENDING] ?? 0) }} 人</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">ロック済み</td>
                                        <td>{{ number_format($userCount[User::STATUS_LOCKED] ?? 0) }} 人</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <h3 class="card-title">アクティビティ</h3>
                    <div class="overflow-y-scroll mb-2" style="max-height: 450px;">
                        <div class="table-responsive">
                            <table class="table table-hover text-center align-middle mb-0">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">日時</th>
                                        <th scope="col">ユーザー</th>
                                        <th scope="col">アクション</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($userActivities as $userActivity)
                                        <tr>
                                            <td>{{ $userActivity->created_at->format('Y年n月j日') }}</td>
                                            <td>
                                                <span>{{ $userActivity->user->last_name }} {{ $userActivity->user->first_name }}</span>
                                                <span class="text-muted">({{ $userActivity->user->login }})</span>
                                            </td>
                                            <td>
                                                @switch($userActivity->action)
                                                    @case('login')
                                                        ログイン
                                                        @break
                                                    @default
                                                        不明
                                                @endswitch
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">データがありません</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('admin.activities') }}" class="btn btn-outline-primary">もっと見る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
