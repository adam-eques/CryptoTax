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
                "route" => route("admin.clients.index")
            ],
            [
                "label" => "Advisors",
                "icon" => "fas-user-nurse",
                "route" => route("admin.tax-advisors.index")
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


