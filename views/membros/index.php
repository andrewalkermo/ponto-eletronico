<!DOCTYPE html>
<html>

    <?php include('../includes/head.inc') ?>

    <body class="panel">

        <header class="gt-top-menu xs-left">
            <img src="/assets/img/projecta-logo.png" alt="Projecta" />
            <label class="menu-toggle">
                <svg viewBox="0 0 24 24">
                <path fill="#333" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z"></path>
                </svg>
            </label>
            <nav>
                <ul>
                    <a href="/#"><li class="active">Painel</li></a>
                    <a href="/views/ponto"><li>Logout</li></a>
                </ul>
            </nav>
        </header>

        <main>
            <section class="center">
                <div class="title">
                    <h1>Painel</h1>
                </div>

                <div class=" center" >
                    <h3>Membros</h3>

                    <table class="gt-table striped hovered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td>Maria C.</td>
                                <td>maria@email.com</td>
                                <td><div class="bar" data-percentage="80%"></div></td>
                                <td>
                                    <a class="action success" title="Edit Page"><i class="fa fa-edit"></i> <span>Edit</span></a>
                                    <a class="action danger" title="Delete"><i class="fa fa-trash"></i> <span>Delete</span></a>
                                    <a class="action info" title="Show Page"><i class="fa fa-eye"></i> <span>Show</span></a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right">
                                    Torne-se forte. :)
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </section>
        </main>

        <script type="text/javascript" src="/vendor/gainTime-2.2.2/js/gaintime.min.js"></script>
        <?php include('../includes/footer.inc') ?>
    </body>

</html>
