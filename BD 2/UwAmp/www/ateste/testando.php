

<html>
<head>
<body>
<!-- Testing the values with if() -->
<select name="options[foo]">
    <option value="1" <?php if ( $options['foo'] == 1 ) echo 'selected="selected"'; ?>>1</option>
    <option value="2" <?php if ( $options['foo'] == 2 ) echo 'selected="selected"'; ?>>2</option>
    <option value="3" <?php if ( $options['foo'] == 3 ) echo 'selected="selected"'; ?>>3</option>
</select>
 
<!-- Using selected() instead -->
<select name="options[foo]">
    <option value="1" <?php selected( $options['foo'], 1 ); ?>>1</option>
    <option value="2" <?php selected( $options['foo'], 2 ); ?>>2</option>
    <option value="3" <?php selected( $options['foo'], 3 ); ?>>3</option>
</select>
</body>
</head>
</html>