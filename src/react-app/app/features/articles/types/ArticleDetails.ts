export type ArticleDetails = {
  id: number;
  title: string;
  userId: number;
  userName: string;
  createdDate: Date;
  published: boolean;
  publishedDate?: Date;
};
