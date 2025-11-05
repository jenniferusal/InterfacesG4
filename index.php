<?php
// 1. INICIAR LA SESIÓN
session_start();

// 2. INICIALIZAR EL CARRITO
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// 3. DEFINICIÓN DE PRODUCTOS
$products = [
    1 => [
        'name' => 'CODE OF VENGEANCE URBAN UPRUISING',
        'price' => 59.99,
        'description' => 'Un juego de acción ambientado en una ciudad en guerra, donde una soldado lucha contra fuerzas enemigas en medio del caos y la destrucción urbana.',
        'imageUrl' => 'juegos/accion.jpg'
    ],
    2 => [
        'name' => 'AETERNA DRAGONIS LEGACY OF ASH',
        'price' => 69.99,
        'description' => 'Un juego de fantasía épica donde una guerrera lucha contra dragones y criaturas oscuras en un mundo arrasado por la guerra y la magia.',
        'imageUrl' => 'juegos/fantasia.jpg'
    ],
    3 => [
        'name' => 'ECHOES OF THE ABYSS DARKNESS AWAITS',
        'price' => 39.99,
        'description' => 'Un juego de terror gótico donde una figura siniestra guía al jugador por una mansión maldita llena de oscuridad y secretos aterradores.',
        'imageUrl' => 'juegos/terror.jpg'
    ],
    4 => [
        'name' => 'STELLARIS ODYSSEY COSSMIC FRONTIER',
        'price' => 49.99,
        'description' => 'Un juego de ciencia ficción espacial donde una tripulación explora los confines del universo, enfrentando amenazas cósmicas y misterios galácticos.',
        'imageUrl' => 'juegos/cienciaficcion.jpg'
    ],
    5 => [
        'name' => 'METROPOLTAN DREAMS FORGE YOUR LEGACY',
        'price' => 45.00,
        'description' => 'Un juego de simulación urbana donde construyes y gestionas una ciudad moderna, equilibrando tecnología, sostenibilidad y crecimiento económico.',
        'imageUrl' => 'juegos/simuladorciudades.jpg'
    ],
    6 => [
        'name' => 'VELOCITY FURY UNTAMED SPEED',
        'price' => 55.00,
        'description' => 'Un juego de carreras futuristas donde motociclistas compiten a toda velocidad por calles iluminadas de una ciudad tecnológica bajo la lluvia.',
        'imageUrl' => 'juegos/carreras.jpg'
    ]
];

// 4. LÓGICA DE GESTIÓN DEL CARRITO
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Acción: Añadir al carrito
    if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
        $productId = (int)$_POST['product_id'];
        if (isset($products[$productId])) {
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]++;
            } else {
                $_SESSION['cart'][$productId] = 1;
            }
        }
        header('Location: ' . $_SERVER['PHP_SELF'] . '?page=home');
        exit;
    }

    // Acción: Eliminar del carrito
    if (isset($_POST['remove_from_cart']) && isset($_POST['product_id'])) {
        $productId = (int)$_POST['product_id'];
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
        header('Location: ' . $_SERVER['PHP_SELF'] . '?page=cart');
        exit;
    }
}

// 5. LÓGICA DE NAVEGACIÓN
$page = $_GET['page'] ?? 'home';

// 6. CÁLCULO DEL CONTADOR DEL CARRITO
$cartCount = 0;
foreach ($_SESSION['cart'] as $quantity) {
    $cartCount += $quantity;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Videojuegos IA (PHP)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .nav-link.active {
            color: #16a34a;
            background-color: #f0fdf4;
        }
        .nav-link {
            font-size: 1.5rem;
            line-height: 1;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-100">

    <!-- ENCABEZADO Y NAVEGACIÓN -->
    <header class="bg-gray-800 shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-2xl font-bold text-green-500">
                GamesForYou
            </div>
            
            <div class="flex space-x-4 items-center">
                <a href="index.php?page=home" class="nav-link text-gray-300 hover:text-green-500 p-2 rounded-full hover:bg-gray-700 <?php echo ($page == 'home') ? 'active' : ''; ?>" title="Inicio">
                    🏠
                </a>
                <a href="index.php?page=map" class="nav-link text-gray-300 hover:text-green-500 p-2 rounded-full hover:bg-gray-700 <?php echo ($page == 'map') ? 'active' : ''; ?>" title="Mapa">
                    🗺️
                </a>
                <a href="index.php?page=payment" class="nav-link text-gray-300 hover:text-green-500 p-2 rounded-full hover:bg-gray-700 <?php echo ($page == 'payment') ? 'active' : ''; ?>" title="Pagos y Envíos">
                    💳
                </a>
                <a href="index.php?page=cart" class="nav-link text-gray-300 hover:text-green-500 p-2 rounded-full hover:bg-gray-700 relative <?php echo ($page == 'cart') ? 'active' : ''; ?>" title="Carrito">
                    🛒
                    <span id="cart-count" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        <?php echo $cartCount; ?>
                    </span>
                </a>
            </div>
        </nav>
    </header>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="container mx-auto p-4 md:p-6">

        <?php
        switch ($page):
            case 'home':
            default:
        ?>
            <!-- Presentación de la Tienda -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-6">
                <h1 class="text-3xl font-bold text-white mb-3">Bienvenidos a GamesForYou</h1>
                <p class="text-gray-300 leading-relaxed">
                    La tienda definitiva para juegos digitales. Todos nuestros títulos conceptuales son generados e inspirados por IA, ofreciendo experiencias únicas que desafían la imaginación. Sumérgete en mundos creados por la sinergia entre la creatividad humana y la inteligencia artificial.
                </p>
            </div>

            <!-- Catálogo de Productos -->
            <h2 class="text-2xl font-semibold text-white mb-4">Nuestros Títulos</h2>
            <div id="product-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <?php foreach ($products as $id => $product): ?>
                    <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden transition-shadow duration-300 hover:shadow-xl hover:shadow-green-500/20">
                        <!--
                            *** ¡CAMBIO AQUÍ! ***
                            Usamos 'aspect-[4/5]' (forma vertical) y 'object-cover' (rellenar).
                        -->
                        <img src="<?php echo htmlspecialchars($product['imageUrl']); ?>" 
                             alt="<?php echo htmlspecialchars($product['description']); ?>" 
                             class="w-full aspect-[4/5] object-cover">
                        
                        <div class="p-4">
                            <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars(ucwords(strtolower($product['name']))); ?></h3>
                            <p class="text-gray-400 text-sm mb-3">
                                <strong>Descripción:</strong> <?php echo htmlspecialchars($product['description']); ?>
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-500"><?php echo number_format($product['price'], 2); ?> €</span>
                                
                                <form method="POST" action="index.php?page=home">
                                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                    <button type="submit" name="add_to_cart" class="bg-green-600 text-white rounded-full p-2 hover:bg-green-700 transition-colors" title="Añadir al carrito">
                                        <!-- 
                                            ¡CAMBIO AQUÍ! 
                                            Reemplazamos el emoji ➕ por un icono SVG.
                                            El "currentColor" tomará el color "text-white" del botón.
                                        -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php
            break; 

            // ---------------------
            // PÁGINA: MAPA
            // ---------------------
            case 'map':
        ?>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold text-white mb-4">Información y Contacto</h1>
                <p class="text-gray-300 mb-4">Somos una tienda 100% digital, pero aquí tienes nuestros datos de contacto.</p>
                
                <!--
                    ¡CAMBIO AQUÍ!
                    He quitado "md:grid-cols-2" para que el contenido (ahora solo una columna) se vea bien.
                -->
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Contacto (Soporte)</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center">
                                <span class="mr-2">📞</span>
                                <span>+34 900 123 456 (Soporte)</span>
                            </li>
                            <li class="flex items-center">
                                <span class="mr-2">✉️</span>
                                <span>soporte@gamershub-ia.com</span>
                            </li>
                            <li class="flex items-center">
                                <span class="mr-2">📍</span>
                                <span>El Ciberespacio (Somos digitales)</span>
                            </li>
                        </ul>
                    </div>
                    
                    <!--
                        ¡CAMBIO AQUÍ!
                        He eliminado todo el <div> que contenía "Nuestra Sede (Virtual)".
                    -->
                </div>
            </div>
        <?php
            break;

            // ---------------------
            // PÁGINA: PAGOS
            // ---------------------
            case 'payment':
        ?>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold text-white mb-4">Métodos de Pago y Envío</h1>
                
                <h3 class="text-xl font-semibold mt-4 mb-2">Métodos de Pago Aceptados</h3>
                <div class="flex flex-wrap gap-4 text-gray-300">
                    <span class="flex items-center"><span class="mr-2">💳</span> Tarjeta de Crédito/Débito</span>
                    <span class="flex items-center"><span class="mr-2">🅿️</span> PayPal</span>
                    <span class="flex items-center"><span class="mr-2">₿</span> Criptomonedas</span>
                </div>

                <h3 class="text-xl font-semibold mt-6 mb-2">Políticas de Envío (Entrega Digital)</h3>
                <p class="text-gray-300 leading-relaxed">
                    ¡Todos nuestros productos son digitales! Recibirás un enlace de descarga y una clave de producto en tu email inmediatamente después de confirmar el pago. Sin esperas, sin gastos de envío.
                </p>
            </div>
        <?php
            break; 

            // ---------------------
            // PÁGINA: CARRITO
            // ---------------------
            case 'cart':
        ?>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold text-white mb-4">Tu Carrito de Compras</h1>
                
                <div id="cart-items-container" class="mb-4">
                    
                    <?php if (empty($_SESSION['cart'])): ?>
                        <p class="text-gray-400">Tu carrito está vacío.</p>
                    <?php else: ?>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $productId => $quantity):
                            if (!isset($products[$productId])) continue;
                            
                            $product = $products[$productId];
                            $subtotal = $product['price'] * $quantity;
                            $total += $subtotal;
                        ?>
                            <div class="flex justify-between items-center border-b border-gray-700 py-3">
                                <div>
                                    <h4 class="text-lg font-medium"><?php echo htmlspecialchars(ucwords(strtolower($product['name']))); ?></h4>
                                    <p class="text-sm text-gray-400">Cantidad: <?php echo $quantity; ?></p>
                                </div>
                                <div class="text-right flex items-center">
                                    <span class="text-lg font-semibold"><?php echo number_format($subtotal, 2); ?> €</span>
                                    
                                    <form method="POST" action="index.php?page=cart" class="ml-4">
                                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                        <button type="submit" name="remove_from_cart" class="text-red-500 hover:text-red-700" title="Eliminar">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
                
                <?php if (!empty($_SESSION['cart'])): ?>
                    <div id="cart-summary" class="border-t border-gray-700 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold">Total:</span>
                            <span class="text-2xl font-bold text-green-500"><?php echo number_format($total, 2); ?> €</span>
                        </div>
                        <button class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg mt-4 hover:bg-green-700 transition-colors">
                            Proceder al Pago
                        </button>
                    </div>
                <?php endif; ?>

            </div>
        <?php
            break; 
        
        endswitch; 
        ?>

    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-gray-400 mt-10 border-t border-gray-700">
        <div class="container mx-auto px-4 py-6 text-center">
            <p>&copy; 2024 GamesForYou. Todos los derechos reservados.</p>
            <p class="text-sm mt-1">Soporte: soporte@gamesforyou.com</p>
        </div>
    </footer>

</body>
</html>