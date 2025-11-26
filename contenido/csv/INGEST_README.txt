1) courses.csv -> title,slug,price_clp,access_months,cover_url
   Ej: Aprendizaje y Desarrollo Personal,aprendizaje-desarrollo-personal,79990,6,https://.../cover.jpg
2) modules.csv -> course_slug,title,position
   Ej: aprendizaje-desarrollo-personal,Neurocomunicación aplicada,2
3) lessons.csv -> module_title,type,title,video_url_or_html,position
   type: video | texto
   Ej: Neurocomunicación aplicada,video,Escucha activa,https://vimeo.com/123456,1
       Herramientas y hábitos,texto,Gestión de hábitos,<p>Contenido...</p>,1
