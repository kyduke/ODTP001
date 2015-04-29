var parser = require("./javascript");
var source = "//comment      \n//2\nvar a = 'abc';\n$L(a);\n$L('a');var ab = $L('ab')";
var ast;

try {
  ast = parser.parse(source);
  console.log(ast);
  console.log(ast.body[0].expression.type, ast.body[0].expression.value + ";");
  console.log(ast.body[1].expression.type, ast.body[1].expression.value);
  console.log(ast.body[2].declarations[0].init.value);
  console.log(ast.body[4].expression.callee.name, ast.body[4].expression.arguments[0].type, ast.body[4].expression.arguments[0].name);
  console.log(ast.body[5].expression.callee.name, ast.body[5].expression.arguments[0].type, ast.body[5].expression.arguments[0].value);
  console.log(ast.body[6].declarations[0].init.callee.name, ast.body[6].declarations[0].init.arguments[0].type, ast.body[6].declarations[0].init.arguments[0].value);
} catch (exception) {
  console.log("Parse Error:  " + exception.message);
}

//grammar

"//".*                             %{
                                        return "COMMENT_LITERAL";
                                   %}
...
Literal
    : NullLiteral
    | BooleanLiteral
    | NumericLiteral
    | CommentLiteral
    | StringLiteral
    | RegularExpressionLiteral
    ;
...
CommentLiteral
    : "COMMENT_LITERAL"
        {
            $$ = new CommentNode($1, createSourceLocation(null, @1, @1));
        }
    ;
...
function CommentNode(value, loc) {
	this.type = "Comment";
	this.value = value.substr(2).trim();
	this.loc = loc;
}
...
parser.ast.CommentNode = CommentNode;
...
