/*
{
    "encoding" : "UTF-8",
    "indent" : {
                "length" : 3,
                "use_space" : true
    },
    "plug-ins" : [ "python", "c++", "ruby" ]
}
*/

#include <json/json.h>

bool ReadFromFile(const char* filename, char* buffer, int len)
{
  FILE* r = fopen(filename, "rb");
  if (NULL == r)
    return false;
  size_t fileSize = fread(buffer, 1, len, r);
  fclose(r);
  return true;
}

int _tmain(int argc, _TCHAR* argv[])
{
  const int BufferLength = 1024;
  char readBuffer[BufferLength] = {0,};
  if (false == ReadFromFile("test.json", readBuffer, BufferLength))
    return 0;
  std::string config_doc = readBuffer;
  Json::Value root;
  Json::Reader reader;
  bool parsingSuccessful = reader.parse( config_doc, root );
  if ( !parsingSuccessful )
  {
    std::cout  << "Failed to parse configuration\n"
      << reader.getFormatedErrorMessages();
    return 0;
  }
  std::string encoding = root.get("encoding", "" ).asString();
  std::cout << encoding << std::endl;
  const Json::Value plugins = root["plug-ins"];
  for ( int index = 0; index < plugins.size(); ++index )
  {
    std::cout << plugins[index].asString() << std::endl;
  }
  std::cout << root["indent"].get("length", 0).asInt() << std::endl;
  std::cout << root["indent"]["use_space"].asBool() << std::endl;
  return 0;
}
