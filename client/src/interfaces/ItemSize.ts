import { IAdminCategory } from "./Category";
import IGender from "./Gender";

interface IItemSize {
  id: number;
  value: string;
  order: string;
}

export interface IAdminItemSize extends IItemSize {
  item_category: IAdminCategory;
  item_person_type: IGender;
  status: boolean;
}

export default IItemSize;
