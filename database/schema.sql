DROP TABLE IF EXISTS links;
DROP TABLE IF EXISTS posts;

CREATE TABLE links (
  id BIGSERIAL PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  url VARCHAR(255) NOT NULL,
  description TEXT NOT NULL
);

INSERT INTO links (title, url, description) VALUES
('Quia in veniam vero ullam ex','http://www.aufderhar.info/','Numquam veritatis earum fugit sed nam magni in tenetur. Sequi veniam excepturi quos eligendi ipsum. Fugit excepturi totam dolores vel ab.'),
('Quam neque aut optio ab quae et','http://www.rau.com/','Ea ipsum perferendis et odit qui fuga. Dolores vitae dolore voluptatem est ut voluptatem quia. Illo ut unde et laborum. Est ducimus quam dolorem repudiandae culpa.'),
('Neque impedit aut soluta','http://watsica.com/','Illo fugit repellat aut in. Quibusdam omnis quas harum voluptatem. Totam sunt ea labore magni iste voluptas voluptatum. Dolorem perferendis est et culpa nulla.');

CREATE TABLE posts (
  id BIGSERIAL PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  excerpt TEXT NOT NULL,
  content TEXT NOT NULL
);

INSERT INTO posts (title, excerpt, content) VALUES
('Dolorem quia enim ut sit vero suscipit quam','Deserunt consectetur natus impedit voluptate aut impedit. Cumque doloremque quam numquam natus esse dolorem non.','Contenido 1'),
('Consequatur expedita ut omnis esse porro voluptate','Et est et doloribus quidem ut sint quibusdam. Id molestiae voluptas qui tempora est.','Contenido 2'),
('Autem fuga consequuntur alias et nostrum unde','Laudantium voluptas perspiciatis consequatur quos quas enim non.','Contenido 3');
