<!-- # @Author: Codeals
# @Date:   09-08-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 09-08-2019
# @Copyright: Codeals
-->

<form class="" action="/sender" method="post">

    <input type="text" name="msg" value="">
    <input type="submit" name="" value="send">
    {{csrf_field()}}
