import requests
import json
import string

def is_numeric(value):
    """判断字符串是否可转换为整数"""
    try:
        int(value)
        return True
    except ValueError:
        return False

def to_int_or_float(value):
    """将字符串转换为整数或浮点数"""
    try:
        return int(value) if value is not None else None
    except ValueError:
        return float(value)

def num_to_alpha(num, length=0):
    """将数字转换为26进制字母表示"""
    chars = string.ascii_lowercase
    res = ''

    if length:
        num = (num - 1) % (26 ** length) + 1

    while num > 0:
        num -= 1
        res = chars[num % 26] + res
        num //= 26

    return res

def alpha_to_num(alpha):
    """将26进制字母表示转换为数字"""
    chars = string.ascii_lowercase
    res = 0

    for c in alpha:
        res *= 26
        res += chars.index(c) + 1

    return res

def strip_line_spaces(string):
    """去除每行开头和结尾的空格"""
    return "\n".join(line.strip() for line in string.strip().split("\n"))

def post(data):
    """向远程服务器发送POST请求"""
    headers = {'Content-Type': 'application/json'}
    response = requests.post('http://enjoy.test/sublime.php', data=json.dumps(data), headers=headers)
    return response.text
