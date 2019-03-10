![WordPress plugin : Encode Shortcode](https://raw.githubusercontent.com/julien-jacob/encode-shortcode/master/assets/banner-772x250.jpg)

# 💌 WordPress plugin : Encode Shortcode

A WordPress plugin to protect the email address in your website against bots or spiders that index or harvest email addresses for sending spam. It uses a substitution cipher with a different key for every page load.

.

.

## 🖋️ How to use in the WordPress editor

    [encode email="email@mail.fr"]

Or :

    [encode email="email@mail.fr"]Text in the link[/encode]

.

.

## 👩‍💻 How to use in PHP

Classic method :

    <?php echo do_shortcode( '[encode email="email@mail.fr"]Text in the link[/encode]' ); ?>

.

.

## 🛠️ How it work

.

🔒📨 The result in the HTML code is like :

    <span id="es-23908716">[Encoded]</span><script type="text/javascript">var a="x78UC50DOygu4kZAGq+ei3TbMfcrNYmvP@62Lznt_dQwJWX91HaIRVKEF.s-SjholpB";var b=a.split("").sort().join("");var c="WVdHRkVdHR8Xs";var d="";for(var e=0;e<c.length;e++)	d+=b.charAt(a.indexOf(c.charAt(e)));document.getElementById("es-23908716").innerHTML="<a href=\"mailto:"+d+"\">"+d+"</a>"</script>

.

🔑💌 The result for the user is like :

    <span id="es-24377098"><a href="mailto:email@mail.fr">Text in the link</a></span>
