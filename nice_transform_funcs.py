import base64
import codecs
import hashlib
import json
import time
import random
import string
from datetime import datetime, date


def transformation(name, key):
    def wrapper(func):
        MY_TRANSFORMATIONS.append((name, key, func))
        return func
    return wrapper


MY_TRANSFORMATIONS = []


@transformation("MD5", "md5")
def md5_transform(v, i, secs):
    """计算字符串 v 的 MD5 哈希值"""
    return hashlib.md5(v.encode()).hexdigest()


@transformation("Reverse", "reverse")
def reverse_transform(v, i, secs):
    """翻转字符串 v"""
    return v[::-1]


@transformation("Base64 Encode", "base64_encode")
def base64_encode_transform(v, i, secs):
    """对字符串 v 进行 Base64 编码"""
    return base64.b64encode(v.encode()).decode()


@transformation("Base64 Decode", "base64_decode")
def base64_decode_transform(v, i, secs):
    """对字符串 v 进行 Base64 解码"""
    return base64.b64decode(v.encode()).decode()


@transformation("Eval", "eval")
def eval_transform(v, i, secs):
    """对字符串 v 执行 eval 操作"""
    try:
        return str(eval(v))
    except Exception as e:
        return "Error: {str(e)}"


@transformation("Time<->Timestamp", "time_timestamp")
def time_timestamp_transform(v, i, secs):
    """
    实现时间字符串和时间戳之间的互转
    如果 v 是一个合法的时间字符串，将其转换成对应的时间戳字符串
    如果 v 是一个合法的时间戳字符串，将其转换成对应的时间字符串
    如果 v 是空字符串，返回当前时间的字符串，格式为 %Y-%m-%d %H:%M:%S
    否则返回空字符串
    """

    if not v:
        # 如果 v 是空字符串，返回当前时间的字符串
        return datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    try:
        # 尝试将 v 解析为时间字符串
        if "." in v:
            dt = datetime.strptime(v, "%Y-%m-%d %H:%M:%S.%f")
        else:
            dt = datetime.strptime(v, "%Y-%m-%d %H:%M:%S")
        return str(int(time.mktime(dt.timetuple())))
    except ValueError:
        pass

    try:
        # 尝试将 v 解析为时间戳字符串
        timestamp = int(v)
        dt = datetime.fromtimestamp(timestamp)
        return dt.strftime("%Y-%m-%d %H:%M:%S")
    except ValueError:
        return ""



@transformation("Unicode -> UTF-8", "unicode_to_utf8")
def unicode_to_utf8_transform(v, i, secs):
    """将 Unicode 编码的字符串 v 转换成 UTF-8 编码的字符串"""
    try:
        return v.encode('utf-8').decode('unicode_escape')
    except Exception as e:
        return "Error occurred: {str(e)}"


@transformation("UTF-8 -> Unicode", "utf8_to_unicode")
def utf8_to_unicode_transform(v, i, secs):
    """将 UTF-8 编码的字符串 v 转换成 Unicode 编码的字符串"""
    try:
        return v.encode('unicode_escape').decode('utf-8')
    except Exception as e:
        return "Error occurred: {str(e)}"

@transformation("ReplaceChars", "replace_chars")
def replace_chars(v, i, secs):
    # 获取所有大小写字母和数字的字符串
    chars = string.ascii_lowercase + string.ascii_uppercase
    # 生成替换规则，用字典来存储
    replace_dict = {}
    for char in chars:
        if char.islower():
            replace_char = random.choice(string.ascii_lowercase.replace(char, ''))
        else:
            replace_char = random.choice(string.ascii_uppercase.replace(char, ''))
        replace_dict[char] = replace_char
    # 生成数字替换规则，加入到替换规则字典中
    replace_dict.update({str(i): str(random.randint(1, 9)) for i in range(10)})
    # 调用translate()方法替换字符串中的字符
    return v.translate(str.maketrans(replace_dict))