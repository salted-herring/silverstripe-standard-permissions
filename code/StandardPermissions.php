<?php
	/**
	 * @file
	 * Adds CMS defined permissions into the code.
	 */
	
	/**
	 * An extension which controls the 'can*' functions in an object.
	 */
	class StandardPermissions extends DataExtension implements PermissionProvider {
	
		/**
		 * Can the user view this?
		 */
		public function canView($member = false) {
			return Permission::check(get_class($this->owner) . '_view');
		}
	
		/**
		 * Can the user edit this?
		 */
		public function canEdit($member = false) {
			return Permission::check(get_class($this->owner) . '_edit');
		}
	
		/**
		 * Can the user delete this?
		 */
		public function canDelete($member = false) {
			return Permission::check(get_class($this->owner) . '_delete');
		}
	
		/**
		 * Can the user create this?
		 */
		public function canCreate($member = false) {
			return Permission::check(get_class($this->owner) . '_create');
		}
	
		/**
		 * Get a complete list of all the permissions this class uses.
		 */
		public function providePermissions() {
	
			// Prepare variables.
			$permissions = array();
	
			// For each class...
			foreach ($this->getClassList() as $class) {
	
				// ...add a few permissions.
				foreach (array(
					'view', 'edit', 'delete', 'create',
				) as $name) {
	
					$permissions[$class . '_' . $name] = $class . '_' . $name;
				}
			}
	
			// Done.
			return $permissions;
		}
	
		/**
		 * Get a list of classes which 'we' extend.
		 */
		private function getClassList() {
	
			// Prepare variables.
			$classes = array();
	
			// Go through all the classes.
			foreach (ClassInfo::subclassesFor('DataObject') as $class => $file) {
	
				// What are the extensions for this class?
				$extensions = Config::inst()->get($class, 'extensions');
				if (!is_null($extensions)) {
	
					// Get a list of classes this horizontally extends this.
					if (in_array(get_class($this), $extensions)) {
						$classes[] = $class;
					}
				}
			}
	
			// Done.
			return $classes;
		}
	}
