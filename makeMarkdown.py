import sys;

class BlogItem(object):
    def __init__(self, year, mouth, date, type, name, url):
        super(BlogItem, self).__init__()
        self.year = year
        self.mouth = mouth;
        self.date = date;
        self.type = type;
        self.name = name;
        self.url = url;

    def printInfo(self):
    	return "+ 《"+self.name+"》";

def saveMarkdown():
	sourceFile = open("ReadList.txt", 'r', encoding="utf-8");
	destFile=open('hello.md','w+');

	githubTitle = "---\ntitle: 那些年，我看过的\ndate: 2013-3-1\n\
description: 我的书籍/电影/电视剧/动漫列表\ncategories:\n- 代码之外 \n\
photos: images/girl.jpg\n---\n\n";
	destFile.write(githubTitle);

	blogItems = [];

	# Year sort 
	years = set();
	for line in sourceFile:
		words = line.split(" ", 4);
		year = words[0].strip();
		mouth = words[1].strip();
		date = words[2].strip();
		type = words[3].strip();
		name = words[4].strip();

		years.add(year);

		blogItems.append(BlogItem(year, mouth, date, type, name, ""));
		

	yearsArray = list(years);
	yearsArray.sort(reverse = True);
	# print(yearsArray);

	# Mouth sort 
	
	for year in yearsArray:
		mouths = set();
		yearBlogItems = list();
		destFile.write("# "+year+"年\n");
		for blogItem in blogItems:
			if (blogItem.year == year):
				mouths.add(blogItem.mouth);
				yearBlogItems.append(blogItem);

		mouthArray = list(mouths);
		mouthArray.sort();
		for mouth in mouthArray:
			destFile.write("## "+mouth+"月\n");
			for blogItem in yearBlogItems:
				destFile.write(blogItem.printInfo()+"\n");
		destFile.write("\r\n");


	sourceFile.close();
	destFile.close();

def main():
	saveMarkdown();
  
if __name__=="__main__":
    main()