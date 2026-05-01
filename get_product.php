<?php
header('Content-Type: application/json');

$productId = $_GET['id'] ?? 2005;

$allProducts = [
    2001 => [
        'ProductID' => 2001,
        'Name' => 'Chocolate Cake',
        'Description' => 'Experience the ultimate indulgence with this rich chocolate cake, layered to perfection and topped with glossy chocolate ganache and fresh strawberry.',
        'Price' => '159.99',
        'Points' => '100',
        'Image' => 'Images/Chocolate Cake.jpeg'
    ],
    2002 => [
        'ProductID' => 2002,
        'Name' => 'Creamy Chocolate Cake',
        'Description' => 'Indulge in the rich layers of this decadent chocolate cake. Perfectly creamy and sweet, each slice boasts an exquisite blend of flavors topped with a hint of cocoa.',
        'Price' => '180.00',
        'Points' => '125',
        'Image' => 'Images/Creamy Chocolate Cake.jpeg'
    ],
    2003 => [
        'ProductID' => 2003,
        'Name' => 'Raspberry Cake',
        'Description' => 'The rich chocolate and fresh raspberries create a harmonious blend of flavors, beautifully presented on a plate. Topped with vibrant raspberries and a hint of mint.',
        'Price' => '149.99',
        'Points' => '90',
        'Image' => 'Images/Raspberry cake.jpeg'
    ],
    2004 => [
        'ProductID' => 2004,
        'Name' => 'Cheesecake with grated chocolate',
        'Description' => 'Indulge in this luscious cheesecake slice, beautifully adorned with rich chocolate drizzle, a vibrant cherry, and delicate chocolate shavings.',
        'Price' => '190.00',
        'Points' => '130',
        'Image' => 'Images/Cheesecake with grated chocolate.png'
    ],
    2005 => [
        'ProductID' => 2005,
        'Name' => 'Tiramisu Cake',
        'Description' => 'This tantalizing tiramisu cake is a slice of the classic Italian dessert, beautifully presented. The cake features layers of creamy mascarpone cheese, chocolate sponge cake, and subtle coffee flavor, all dusted with cocoa powder.',
        'Price' => '200.00',
        'Points' => '150',
        'Image' => 'Images/Tiramisu Cake.jpeg'
    ],
    2006 => [
        'ProductID' => 2006,
        'Name' => 'Chocolate Pancake',
        'Description' => 'Indulge in the delectable delights of soft, fluffy pancakes generously drizzled with rich, velvety chocolate sauce.',
        'Price' => '99.99',
        'Points' => '50',
        'Image' => 'Images/Chocolate Pancake.jpeg'
    ],
    2007 => [
        'ProductID' => 2007,
        'Name' => 'Strawberry Pancake',
        'Description' => 'Indulge in this mouthwatering featuring fluffy pancakes filled with fresh strawberries. Topped with powdered sugar and accompanied by vibrant strawberries.',
        'Price' => '90.00',
        'Points' => '55',
        'Image' => 'Images/strawberry pancake.png'
    ],
    2008 => [
        'ProductID' => 2008,
        'Name' => 'Stacked Fluffy Pancake',
        'Description' => 'Indulge in this mouthwatering featuring a towering stack of golden pancakes drizzled with syrup, topped with fresh blueberries, raspberries, and mint leaves.',
        'Price' => '150.00',
        'Points' => '90',
        'Image' => 'Images/Stackedfluffypancake.png'
    ]
];

if (isset($allProducts[$productId])) {
    echo json_encode(['success' => true, 'data' => $allProducts[$productId]]);
} else {
    echo json_encode(['success' => false, 'error' => 'Product not found']);
}
?>