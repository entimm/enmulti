import base64
import hashlib


def transformation(name, key):
    def wrapper(func):
        MY_TRANSFORMATIONS.append((name, key, func))
        return func
    return wrapper


MY_TRANSFORMATIONS = []


@transformation("MD5", "md5")
def md5_transform(v, i, secs):
    return hashlib.md5(v.encode()).hexdigest()


@transformation("Reverse", "reverse")
def reverse_transform(v, i, secs):
    return v[::-1]


@transformation("Base64 Encode", "base64_encode")
def base64_encode_transform(v, i, secs):
    return base64.b64encode(v.encode()).decode()


@transformation("Base64 Decode", "base64_decode")
def base64_decode_transform(v, i, secs):
    return base64.b64decode(v.encode()).decode()
