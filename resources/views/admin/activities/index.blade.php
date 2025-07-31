<x-layout title="アクティビティ">
    <h2>アクティビティ</h2>
    <div class="table-responsive">
        <table class="table table-hover text-center align-middle mb-0">
            <thead class="table-primary">
                <tr>
                    <th scope="col">日時</th>
                    <th scope="col">ユーザー</th>
                    <th scope="col">アクション</th>
                    <th scope="col">IPアドレス</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($activities as $activity)
                    <tr>
                        <td>{{ $activity->created_at->format('Y年n月j日 H:i') }}</td>
                        <td>
                            <span>{{ $activity->user->last_name }} {{ $activity->user->first_name }}</span>
                            <span class="text-muted">({{ $activity->user->login }})</span>
                        </td>
                        <td>
                            @switch($activity->action)
                                @case('login')
                                    ログイン
                                    @break
                                @default
                                    不明
                            @endswitch
                        </td>
                        <td>{{ $activity->ip_address }}</td>
                        <td>
                            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#contextModal" data-context-raw="#contextRaw_{{ $activity->id }}">情報</button>
                            <p id="contextRaw_{{ $activity->id }}" class="d-none">@json($activity->context)</p>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">データがありません</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="contextModal" tabindex="-1" aria-labelledby="contextModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title fs-5" id="contextModalLabel">情報</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <pre><code></code></pre>
                </div>
            </div>
        </div>
    </div>
    @push('javascript')
        <script src="{{ asset('js/admin/activities.js') }}"></script>
    @endpush
</x-layout>
