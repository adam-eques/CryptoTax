<?php
$items = [
    [
        "label" => "Dashboard",
        "icon" => "fas-home",
        "route" => route("dashboard")
    ],
    [
        "label" => "User",
        "icon" => "fas-users",
        "children" =>[
            [
                "label" => "Clients",
                "icon" => "fas-users",
                "route" => route("admin.users.index")
            ],
            [
                "label" => "Advisors",
                "icon" => "fas-user-nurse",
                "route" => route("todo")
            ],
        ]
    ],
    [
        "label" => "Advertising",
        "icon" => "fas-users",
        "children" =>[
            [
                "label" => "Advertising",
                "icon" => "fas-ad",
                "route" => route("todo")
            ],
        ]
    ],
    [
        "label" => "Finance",
        "icon" => "fas-users",
        "children" =>[
            [
                "label" => "Finance",
                "icon" => "fas-coins",
                "route" => route("todo")
            ],
        ]
    ],
    [
        "label" => "API's",
        "icon" => "fas-users",
        "children" =>[
            [
                "label" => "API's",
                "icon" => "fas-network-wired",
                "route" => route("todo")
            ],
        ]
    ]
];
?>

<ul class="space-y-4 px-6 py-4">
    @foreach($items AS $item)
        @if(!$loop->first)
            <li>
                <div class="border-t -mr-8 -ml-8 border-gray-700"></div>
            </li>
        @endif

        @if(isset($item["children"]))
            <li>
                <p class="font-bold uppercase text-gray-500 text-sm tracking-wider mb-2">{{ $item["label"] }}</p>
                <ul class="text-sm space-y-1 -mx-3 mt-2">
                    @foreach($item["children"] AS $row)
                        <li>
                            <a href="{{ $row['route'] }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition hover:bg-gray-200/5 focus:bg-gray-500/5">
                                <x-icon :name="$row['icon']" class="w-5" /> {{ $row["label"] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li>
                <ul class="text-sm space-y-1 -mx-3">
                    <li>
                        <a href="http://deskly.local/admin" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium transition hover:bg-gray-200/5 focus:bg-gray-500/5">
                            <x-icon :name="$item['icon']" class="w-5" /> {{ $item["label"] }}
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    @endforeach
</ul>
