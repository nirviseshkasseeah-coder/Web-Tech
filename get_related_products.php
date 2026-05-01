<?php
header('Content-Type: application/json');

$allProducts = [
    2001 => [
        'ProductID' => 2001,
        'Name' => 'Chocolate Cake',
        'Description' => 'Experience the ultimate indulgence with this rich chocolate cake...',
        'Price' => '159.99',
        'Points' => '100',
        'Image' => 'Images/Chocolate Cake.jpeg'
    ],
    2002 => [
        'ProductID' => 2002,
        'Name' => 'Creamy Chocolate Cake',
        'Description' => 'Indulge in the rich layers of this decadent chocolate cake...',
        'Price' => '180.00',
        'Points' => '125',
        'Image' => 'Images/Creamy Chocolate Cake.jpeg'
    ],
    2003 => [
        'ProductID' => 2003,
        'Name' => 'Raspberry Cake',
        'Description' => 'The rich chocolate and fresh raspberries create a harmonious blend...',
        'Price' => '149.99',
        'Points' => '90',
        'Image' => 'Images/Raspberry cake.jpeg'
    ],
    2004 => [
        'ProductID' => 2004,
        'Name' => 'Cheesecake with grated chocolate',
        'Description' => 'Indulge in this luscious cheesecake slice...',
        'Price' => '190.00',
        'Points' => '130',
        'Image' => 'Images/Cheesecake with grated chocolate.png'
    ],
    2005 => [
        'ProductID' => 2005,
        'Name' => 'Tiramisu Cake',
        'Description' => 'This tantalizing tiramisu cake is a slice of the classic Italian dessert...',
        'Price' => '200.00',
        'Points' => '150',
        'Image' => 'Images/Tiramisu Cake.jpeg'
    ],
    2006 => [
        'ProductID' => 2006,
        'Name' => 'Chocolate Pancake',
        'Description' => 'Indulge in the delectable delights of soft, fluffy pancakes...',
        'Price' => '99.99',
        'Points' => '50',
        'Image' => 'Images/Chocolate Pancake.jpeg'
    ],
    2007 => [
        'ProductID' => 2007,
        'Name' => 'Strawberry Pancake',
        'Description' => 'Indulge in this mouthwatering featuring fluffy pancakes...',
        'Price' => '90.00',
        'Points' => '55',
        'Image' => 'Images/strawberry pancake.png'
    ],
    2008 => [
        'ProductID' => 2008,
        'Name' => 'Stacked Fluffy Pancake',
        'Description' => 'Indulge in this mouthwatering featuring a towering stack...',
        'Price' => '150.00',
        'Points' => '90',
        'Image' => 'Images/Stackedfluffypancake.png'
    ]
];

$currentId = (int)($_GET['id'] ?? 2005);
$limit = (int)($_GET['limit'] ?? 3);

$related = [];
foreach ($allProducts as $key => $product) {
    if ($key !== $currentId && count($related) < $limit) {
        $related[] = $product;
    }
}

echo json_encode(['success' => true, 'data' => $related]);
?>