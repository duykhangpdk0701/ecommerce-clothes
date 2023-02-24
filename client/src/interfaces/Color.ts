interface IColor {
  id: number;
  name: string;
  value: string;
}

export interface IAdminColor extends IColor {
  order: number;
  status: boolean;
}

export default IColor;
